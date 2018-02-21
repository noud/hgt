<?php

namespace HGT\AppBundle\Controller\Catalog;

use HGT\AppBundle\Form\Catalog\Product\AddToCartForm;
use HGT\Application\Catalog\Category\Category;
use HGT\Application\Catalog\CategoryService;
use HGT\Application\Catalog\ProductPriceService;
use HGT\Application\Catalog\ProductService;
use HGT\Application\Catalog\ProductUnitOfMeasureService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @Route("/product/view/{product_id}", name="product_view")
     * @param Request $request
     * @param ProductService $productService
     * @param CategoryService $categoryService
     * @param ProductPriceService $productPriceService
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     * @param $product_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, ProductService $productService, CategoryService $categoryService, ProductPriceService $productPriceService, ProductUnitOfMeasureService $productUnitOfMeasureService, $product_id)
    {
        $product = $productService->getProductById($product_id);

        if($product === null) {
            throw new NotFoundHttpException();
        }

        /** @var Category $productCategory */
        $productCategory = $product->getCategory()->getParent()->getId();
        $parentCategories = $categoryService->getCategoriesWithProducts($productCategory);
        $productUnitOfMeasures = $productUnitOfMeasureService->getProductUnitOfMeasures($product);

        $productPrices = array();
        foreach($productUnitOfMeasures as $productUnitOfMeasure) {
            $productPrices[] = [
                'productUnitOfMeasureId' => $productUnitOfMeasure->getUnitOfMeasure()->getId(),
                'productPrice' => $productPriceService->getUnitPriceForCustomer($this->getUser(), $product, $productUnitOfMeasure->getUnitOfMeasure()),
            ];
        }

        $form = $this->createForm(AddToCartForm::class);

        return $this->render('catalog/product/view.html.twig', [
            'product' => $product,
            'parentCategories' => $parentCategories,
            'productPrices' => $productPrices,
            'form' => $form->createView(),
        ]);
    }
}
