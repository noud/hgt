<?php

namespace HGT\AppBundle\Controller\Catalog;

use HGT\Application\Catalog\Category\Category;
use HGT\Application\Catalog\CategoryService;
use HGT\Application\Catalog\ProductCategoryService;
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
     * @Route("/product/view/{id}", name="product_view")
     * @param Request $request
     * @param ProductService $productService
     * @param CategoryService $categoryService
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, ProductService $productService, CategoryService $categoryService, ProductUnitOfMeasureService $productUnitOfMeasureService, $id)
    {
        $product = $productService->getProductById($id);

        if($product === null) {
            throw new NotFoundHttpException();
        }

        /** @var Category $productCategory */
        $productCategory = $product->getCategory()->getParent()->getId();
        $parentCategories = $categoryService->getCategoriesWithProducts($productCategory);
        $productUnitOfMeasure = $productUnitOfMeasureService->getProductUnitOfMeasures($id);

        return $this->render('catalog/product/view.html.twig', [
            'product' => $product,
            'parentCategories' => $parentCategories,
            'productUnitOfMeasure' => $productUnitOfMeasure,
        ]);
    }
}
