<?php

namespace HGT\AppBundle\Controller\Catalog;

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
     * @Route("/merk/{name}", name="manufacturer_view")
     * @param $name
     * @param ManufacturerService $manufacturerService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(
        $name,
        ManufacturerService $manufacturerService
    ) {
         return $this->render('catalog/manufacture/view.html.twig', [
             'manufacturer' => $manufacturerService->getManufactureWithProducts($name)
        ]);
    }
}
