<?php

namespace HGT\AppBundle\Controller\Catalog;

use HGT\Application\Catalog\CategoryService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/category", name="category_index")
     * @param Request $request
     * @param CategoryService $categoryService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, CategoryService $categoryService)
    {
        $categories = $categoryService->getHomeCategories("NULL");

        return $this->render('catalog/category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/view/{id}", name="category_view")
     * @param $id
     * @param Request $request
     * @param CategoryService $categoryService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, CategoryService $categoryService, $id)
    {
        $category = $categoryService->get($id);
        $parentId = $category->getParent() ? $category->getParent()->getId() : null;
        $parentCategory = $categoryService->getParentCategory($parentId);
        $superCategories = $categoryService->getCategoriesWithProducts($id);

        $parentCategories = ($parentCategory !== null ?
            $categoryService->getSuperCategoriesWithProducts($parentId) :
            $categoryService->getCategoriesWithProducts("NULL")
        );

        return $this->render('catalog/category/view.html.twig', [
            'category' => $category,
            'categories' => $superCategories,
            'parentCategories' => $parentCategories,
        ]);
    }
}
