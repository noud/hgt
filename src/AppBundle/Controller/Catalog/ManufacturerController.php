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
        $manufacturersObjects = $manufacturerService->getManufacturersWithProducts();

        $manufacturerCats = [];

        foreach ($manufacturersObjects as $object) {
            if (strpos(htmlentities($object->getName()), '&') === 0) {
                $firstLetter = strtoupper(substr(trim(htmlentities($object->getName())), 1, 1));
            } else {
                $firstLetter = strtoupper(substr(trim($object->getName()), 0, 1));
                if ($firstLetter < 'A' || $firstLetter > 'Z') {
                    $firstLetter = '-';
                }
            }

            if (!isset($manufacturerCats[$firstLetter])) {
                $manufacturerCats[$firstLetter] = [];
            }

            $manufacturerCats[$firstLetter][] = $object;
        }

        return $this->render('catalog/manufacture/index.html.twig', [
            'manufacturerCats' => $manufacturerCats
        ]);
    }
}
