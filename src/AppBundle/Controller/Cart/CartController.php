<?php

namespace HGT\AppBundle\Controller\Cart;

use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Form\Catalog\Cart\CartForm;
use HGT\Application\Catalog\Cart\CartProduct;
use HGT\Application\Catalog\Cart\Command\ReviseCartProductCommand;
use HGT\Application\Catalog\CartProductService;
use HGT\Application\Catalog\CartService;
use HGT\Application\Catalog\InvalidDeliveryDateService;
use HGT\Application\User\CustomerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CartController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/cart", name="cart_index")
     * @param Request $request
     * @param CartService $cartService
     * @param CustomerService $customerService
     * @param InvalidDeliveryDateService $invalidDeliveryDateService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(
        Request $request,
        CartService $cartService,
        CustomerService $customerService,
        InvalidDeliveryDateService $invalidDeliveryDateService
    ) {
        $cart = $cartService->getOpenCart();
        $cartProducts = $cart->getCartProducts();
        $customer = $customerService->getCurrentCustomer();

        $cartService->updateProductPrices($customer, $cart);

        $command = new ReviseCartProductCommand($cartProducts, $cart);
        $form = $this->createForm(CartForm::class, $command);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command->client_ip = $request->getClientIp();
            $cartService->reviseCart($command);

            switch ($command->form_action) {
                case 'update':
                    $this->addFlash('success', 'Winkelwagen succesvol bijgewerkt.');
                    break;
                case 'finish':
                    $cartService->finish($cart);
                    $this->entityManager->flush();
                    return $this->redirectToRoute('cart_success');
                    break;
            }
        }

        return $this->render('catalog/cart/index.html.twig', [
            'validDeliveryDays' => $customerService->getValidDeliveryDays($customer),
            'invalidDeliveryDates' => $invalidDeliveryDateService->getInvalidDeliveryDatesAsDateArray(),
            'validDeliveryDates' => $invalidDeliveryDateService->getValidDeliveryDatesAsDateArray(),
            'cartTotal' => $cartService->calculateTotalExTax($cart),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cart/removeproduct/{id}", name="cart_product_remove")
     * @param CartProduct $cartProduct
     * @param CartProductService $cartProductService
     * @param CartService $cartService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeProductAction(
        CartProduct $cartProduct,
        CartProductService $cartProductService,
        CartService $cartService
    ) {
        $cart = $cartService->getOpenCart();

        if ($cart !== null && $cartProduct->getCart()->getId() == $cart->getId()) {
            $cartProductService->removeCartProduct($cartProduct);
        }

        $this->entityManager->flush();

        $this->addFlash('success', 'Product is verwijderd uit uw winkelwagen.');

        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/cart/success", name="cart_success")
     */
    public function successAction()
    {
        return $this->render('catalog/cart/success.html.twig');
    }
}
