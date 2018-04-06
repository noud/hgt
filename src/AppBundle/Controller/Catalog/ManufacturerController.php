<?php

namespace HGT\AppBundle\Controller\Catalog;

use HGT\Application\Breadcrumb\BreadcrumbService;
use HGT\Application\Catalog\CategoryService;
use HGT\Application\Catalog\ManufacturerService;
use HGT\Application\Catalog\ProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManufacturerController extends controller
{
    /**
     * @Route("/merken", name="manufacturer_index")
     * @param ManufacturerService $manufacturerService
     * @param BreadcrumbService $breadcrumbService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(
        Request $request,
        ManufacturerService $manufacturerService,
        BreadcrumbService $breadcrumbService
    ) {
        $breadcrumbService->addBreadcrumb('merken', '');
        $breadcrumbs = $breadcrumbService->getBreadcrumbs();

        return $this->render('catalog/manufacture/index.html.twig', [
            'manufacturerCats' => $manufacturerService->getManufacturerLetterIndex(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * @Route("/merk/{id}", name="manufacturer_view")
     * @param $id
     * @param Request $request
     * @param ManufacturerService $manufacturerService
     * @param CategoryService $categoryService
     * @param ProductService $productService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(
        $id,
        Request $request,
        ManufacturerService $manufacturerService,
        CategoryService $categoryService,
        ProductService $productService
    ) {
        $categories = $categoryService->getHomeCategories();
        $manufacturer = $manufacturerService->getManufactureWithProducts($id);

        if ($manufacturer->getProducts()) {
            $currentPage = $request->query->has('p') ? (int)$request->query->get('p') : 1;
            $perPage = $request->query->has('limit') ? (int)$request->query->get('limit') : 10;

            $resultNumber = 0;
            $results = $productService->getPagedManufactureWithProducts($currentPage, $perPage, $manufacturer);

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
        }

        return $this->render('catalog/manufacture/view.html.twig', [
            'manufacturer' => $manufacturer,
            'categories' => $categories,
            'products' => $results,
            'pagination' => $pagination,
            'perPage' => $perPage
        ]);
    }
}
