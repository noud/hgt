<?php

namespace HGT\AppBundle\Controller\Catalog;

use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Form\Catalog\Product\AddToCartForm;
use HGT\Application\Catalog\Cart\Command\DefineCartProductCommand;
use HGT\Application\Catalog\CartProductService;
use HGT\Application\Catalog\CartService;
use HGT\Application\Catalog\Category\Category;
use HGT\Application\Catalog\CategoryService;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\ProductPriceService;
use HGT\Application\Catalog\ProductUnitOfMeasureService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class ProductController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ProductController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/product/view/{id}", name="product_view")
     * @param Request $request
     * @param CartProductService $cartProductService
     * @param CategoryService $categoryService
     * @param ProductPriceService $productPriceService
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     * @param CartService $cartService
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function viewAction(
        Request $request,
        CartProductService $cartProductService,
        CategoryService $categoryService,
        ProductPriceService $productPriceService,
        ProductUnitOfMeasureService $productUnitOfMeasureService,
        CartService $cartService,
        Product $product
    ) {
        $productCategory = $product->getCategory();

        if ($productCategory->getParent()) {
            $productCategory = $productCategory->getParent()->getId();
        }

        $parentCategories = $categoryService->getCategoriesWithProducts($productCategory);
        $productUnitOfMeasures = $productUnitOfMeasureService->getProductUnitOfMeasures($product);

        $productPrices = array();
        foreach ($productUnitOfMeasures as $productUnitOfMeasure) {
            $productPrices[] = [
                'productUnitOfMeasureId' => $productUnitOfMeasure->getUnitOfMeasure()->getId(),
                'productPrice' => $productPriceService->getUnitPriceForCustomer(
                    $this->getUser(),
                    $product,
                    $productUnitOfMeasure->getUnitOfMeasure()
                ),
            ];
        }

        $singleProductData = [
            'product' => $product,
            'parentCategories' => $parentCategories,
            'productPrices' => $productPrices,
            'isCustomer' => false
        ];

        if ($this->isGranted('ROLE_CUSTOMER')) {
            $cart = $cartService->getOpenCart();
            $command = new DefineCartProductCommand($product, $cart);

            $form = $this->createForm(AddToCartForm::class, $command);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                switch ($command->form_action) {
                    case "add":
                        $cartProductService->defineCartProduct($command);
                        break;
                }

                $this->entityManager->flush();

                $this->addFlash('success', 'Product is toegevoegd aan uw winkelwagen.');
                return $this->redirectToRoute('cart_index');
            }

            $singleProductData['addToCartForm'] = $form->createView();
            $singleProductData['isCustomer'] = true;
        }

        return $this->render('catalog/product/view.html.twig', $singleProductData);
    }
}
