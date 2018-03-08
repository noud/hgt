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
     *
     * @param Request $request
     * @param ManufacturerService $manufacturerService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(
        Request $request,
        ManufacturerService $manufacturerService
    ) {
        $manufacturersObjects = $manufacturerService->getManufacturersWithProducts();
        $manufacturerNames = [];

        foreach ($manufacturersObjects as $obj) {
            $manufacturerNames[] = $obj->getName();
        }

        foreach ($manufacturerNames as $name) {
            if (strpos(htmlentities($name), '&') === 0) {
                $firstLetter = strtoupper(substr(trim(htmlentities($name)), 1, 1));
            } else {
                $firstLetter = strtoupper(substr(trim($name), 0, 1));
                if ($firstLetter < 'A' || $firstLetter > 'Z') {
                    $firstLetter = '-';
                }
            }

            if (!isset($manufacturerCats[$firstLetter])) {
                $manufacturerCats[$firstLetter] = [];
            }

            $manufacturerCats[$firstLetter][] = $name;
        }

        return $this->render('catalog/manufacture/index.html.twig', [
            'manufacturerCats' => $manufacturerCats
        ]);
    }
}
