<?php

namespace HGT\AppBundle\Controller\Manufacturer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ManufacturerController extends controller
{

    /**
     * @Route("/merken", name="manufacturer_index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(
        Request $request
    ) {
        return $this->render('manufacturer/index.html.twig', [

        ]);
    }

}