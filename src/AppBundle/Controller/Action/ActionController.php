<?php

namespace HGT\AppBundle\Controller\Action;

use HGT\Application\Catalog\ProductService;
use HGT\Application\Catalog\ProductUnitOfMeasureService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActionController extends Controller
{
    /**
     * @Route("/acties", name="action_index")
     * @param Request $request
     * @param ProductService $productService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(
        Request $request,
        ProductService $productService,
        ProductUnitOfMeasureService $productUnitOfMeasureService
    ) {
        $actionProducts = $productService->getActionProducts($this->isGranted('ROLE_CUSTOMER'));

        return $this->render('actions/index.html.twig', [
            'actionProducts' => $actionProducts
        ]);
    }
}
