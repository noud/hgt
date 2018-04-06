<?php

namespace HGT\AppBundle\Controller\Catalog;

use HGT\Application\Catalog\CategoryService;
use HGT\Application\Catalog\ManufacturerService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManufacturerController extends controller
{
    /**
     * @Route("/merken", name="manufacturer_index")
     * @param Request $request
     * @param ManufacturerService $manufacturerService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(
        Request $request,
        ManufacturerService $manufacturerService
    ) {
        return $this->render('catalog/manufacture/index.html.twig', [
            'manufacturerCats' => $manufacturerService->getManufacturerLetterIndex(),
        ]);
    }

    /**
     *
     * @Route("/merk/{id}", name="manufacturer_view")
     * @param $name
     * @param ManufacturerService $manufacturerService
     * @param CategoryService $categoryService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(
        $id,
        ManufacturerService $manufacturerService,
        CategoryService $categoryService
    ) {
        $categories = $categoryService->getHomeCategories();
        dump($categories);
         return $this->render('catalog/manufacture/view.html.twig', [
             'manufacturer' => $manufacturerService->getManufactureWithProducts($id),
             'categories' => $categories
        ]);
    }
}
