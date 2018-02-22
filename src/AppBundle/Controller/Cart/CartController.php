<?php

namespace HGT\AppBundle\Controller\Cart;

use HGT\AppBundle\Form\Catalog\Cart\CartForm;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Cart\CartProduct;
use HGT\Application\Catalog\Cart\Command\DefineCartProductCommand;
use HGT\AppBundle\Form\Catalog\Product\AddToCartForm;
use HGT\Application\Catalog\Cart\Command\ReviseCartProductCommand;
use HGT\Application\Catalog\CartProductService;
use HGT\Application\Catalog\CartService;
use HGT\Application\Catalog\ProductService;
use HGT\Application\Catalog\ProductUnitOfMeasureService;
use HGT\Application\User\CustomerService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart_index")
     * @param Request $request
     * @param CartService $cartService
     * @param CustomerService $customerService
     * @param CartProductService $cartProductService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function indexAction(
        Request $request,
        CartService $cartService,
        CustomerService $customerService,
        CartProductService $cartProductService
    ) {
        // redirect if user is not logged in
        if (!$this->getUser()) {
            return $this->redirectToRoute('account_login');
        }

        /** @var Cart $cart */
        $cart = $customerService->getOpenCart();
        $cartProducts = $cartProductService->getCartProducts($cart);
        $customer = $customerService->getCurrentCustomer();

        $cartService->updateProductPrices($customer, $cart);

        $command = new ReviseCartProductCommand($cartProducts, $cart);
        $form = $this->createForm(CartForm::class, $command, [
            'method' => 'post',
            'action' => $this->generateUrl('cart_index'),
            'attr' => [
                'id' => 'cart_form',
            ]
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            switch ($command->form_action) {
                case "update":
                    /** @var CartProduct $cartProductForm */
                    foreach ($command->products as $cartProductForm) {
                        $cartProductItem = $cartProductService->getCartProductById($cartProductForm->getId());
                        $cartProductItem->setQty($cartProductForm->getQty());
                    }

                    $cart->setNote($command->note);
                    $cart->setDeliveryDate($command->delivery_date);
                    $cart->setReference($command->reference);

                    $this->addFlash('success', 'Winkelwagen succesvol bijgewerkt.');
                    break;
                case "finish":
                    // bestelling afronden
                    break;
            }

            $em->persist($cart);
            $em->flush();
        }

        return $this->render('catalog/cart/index.html.twig', [
            'cartTotal' => $cartService->calculateTotalExTax($cart),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cart/addproduct/{product_id}", name="cart_product_add")
     * @Method("POST")
     * @param Request $request
     * @param ProductService $productService
     * @param CartProductService $cartProductService
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addProductAction(
        Request $request,
        ProductService $productService,
        CartProductService $cartProductService,
        ProductUnitOfMeasureService $productUnitOfMeasureService
    ) {
        // redirect if user is not logged in
        if (!$this->getUser()) {
            return $this->redirectToRoute('account_login');
        }

        $product = $productService->getProductById($request->get('product_id'));

        if ($product === null) {
            throw new NotFoundHttpException();
        }

        $cartProductCommand = new DefineCartProductCommand($product);

        $form = $this->createForm(AddToCartForm::class, $cartProductCommand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($cartProductCommand); exit;
            $em = $this->getDoctrine()->getManager();
            $cartProductService->defineCartProduct($cartProductCommand);
            $em->flush();

            $this->addFlash('confirm', 'Product is toegevoegd aan uw winkelwagen.');
        }

        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/cart/removeproduct/{product_id}", name="cart_product_remove")
     * @param Request $request
     * @param CartProductService $cartProductService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeProductAction(Request $request, CartProductService $cartProductService)
    {
        // redirect if user is not logged in
        if (!$this->getUser()) {
            return $this->redirectToRoute('account_login');
        }

        $em = $this->getDoctrine()->getManager();

        $cartProduct = $cartProductService->getCartProductById($request->get('product_id'));
        $cartProductService->removeCartProduct($cartProduct);

        $em->flush();

        $this->addFlash('confirm', 'Product is verwijderd uit uw winkelwagen.');
        return $this->redirectToRoute('cart_index');
    }
}
