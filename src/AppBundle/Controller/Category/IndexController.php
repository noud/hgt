<?php

namespace HGT\AppBundle\Controller\Category;

use HGT\Application\Catalog\CategoryService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @Route("/category", name="category_index")
     * @param Request $request
     * @param CategoryService $categoryService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, CategoryService $categoryService)
    {
        $categories = $categoryService->getHomeCategories("NULL");

        return $this->render('category/index.html.twig', [
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
    public function viewAction($id, Request $request, CategoryService $categoryService)
    {
        $categoryInfo = $categoryService->get($id);
        $superCategories = $categoryService->getCategoriesWithProducts($id);

        if (count($superCategories) === 0) {
            $products = 'X';
        }

        return $this->render('category/view.html.twig', [
            'categoryInfo' => $categoryInfo,
            'categories' => $superCategories,
            'products' => 'XX'
        ]);
    }
}
