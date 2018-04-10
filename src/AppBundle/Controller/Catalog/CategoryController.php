<?php

namespace HGT\AppBundle\Controller\Catalog;

use HGT\Application\Breadcrumb\BreadcrumbService;
use HGT\Application\Catalog\CategoryService;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\ProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/category", name="category_index")
     * @param Request $request
     * @param CategoryService $categoryService
     * @param BreadcrumbService $breadcrumbService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(
        Request $request,
        CategoryService $categoryService,
        BreadcrumbService $breadcrumbService
    ) {
        $categories = $categoryService->getCategoriesWithProducts("NULL");

        $breadcrumbService->addBreadcrumb('categorieën', '');
        $breadcrumbs = $breadcrumbService->getBreadcrumbs();

        return $this->render('catalog/category/index.html.twig', [
            'categories' => $categories,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * @Route("/category/view/{id}", name="category_view")
     * @param Request $request
     * @param CategoryService $categoryService
     * @param BreadcrumbService $breadcrumbService
     * @param ProductService $productService
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(
        Request $request,
        CategoryService $categoryService,
        BreadcrumbService $breadcrumbService,
        ProductService $productService,
        $id
    ) {
        $category = $categoryService->get($id);
        $parentId = $category->getParent() ? $category->getParent()->getId() : null;
        $parentCategory = $categoryService->getParentCategory($parentId);
        $superCategories = $categoryService->getCategoriesWithProducts($id);

        $parentCategories = ($parentCategory !== null ?
            $categoryService->getSuperCategoriesWithProducts($parentId) :
            $categoryService->getCategoriesWithProducts("NULL")
        );

        $productCategoryData = array();

        $productCategoryData['category'] = $category;
        $productCategoryData['categories'] = $superCategories;
        $productCategoryData['parentCategories'] = $parentCategories;

        if ($category->getProducts()) {
            $currentPage = $request->query->has('p') ? (int)$request->query->get('p') : 1;
            $perPage = $request->query->has('limit') ? (int)$request->query->get('limit') : 10;

            $resultNumber = 0;
            $results = $productService->getPagedCategoryProducts($currentPage, $perPage, $category);

            $paginator = $results;
            $pagination = array(
                'current' => $currentPage,
                'pages' => ceil($paginator->count() / $perPage)
            );

            if ($currentPage != 1 && ($currentPage > $pagination['pages'] || $currentPage < 1)) {
                throw $this->createNotFoundException();
            }

            foreach ($results as $result) {
                $resultNumber += count($result);
            }

            $productCategoryData['products'] = $results;
            $productCategoryData['pagination'] = $pagination;
            $productCategoryData['perPage'] = $perPage;
        }

        $breadcrumbService->addBreadcrumb($category->getName(), '');

        // find all parents
        $parentCategory = $categoryService->getParentCategory($parentId);
        while ($parentCategory) {
            $url = $this->generateUrl('category_view', array('id' => $parentCategory->getId()));
            $breadcrumbService->addBreadcrumb($parentCategory->getName(), $url);
            $parentId = $parentCategory->getParent() ? $parentCategory->getParent()->getId() : null;
            $parentCategory = $categoryService->getParentCategory($parentId);
        }

        $url = $this->generateUrl('category_index');
        $breadcrumbService->addBreadcrumb('categorieën', $url);
        $productCategoryData['breadcrumbs'] = $breadcrumbService->getBreadcrumbs();

        return $this->render('catalog/category/view.html.twig', $productCategoryData);
    }
}
