<?php

namespace HGT\AppBundle\Controller\Action;

use HGT\Application\Breadcrumb\BreadcrumbService;
use HGT\Application\Catalog\ProductService;
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
        ProductService $productService,
        BreadcrumbService $breadcrumbService
    ) {
        $actionProducts = $productService->getActionProducts($this->isGranted('ROLE_CUSTOMER'));

        $breadcrumbService->addBreadcrumb('Acties', '');
        $breadcrumbs = $breadcrumbService->getBreadcrumbs();

        return $this->render('actions/index.html.twig', [
            'actionProducts' => $actionProducts,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
