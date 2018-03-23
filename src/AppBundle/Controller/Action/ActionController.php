<?php

namespace HGT\AppBundle\Controller\Action;

use HGT\Application\Catalog\ProductPriceService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActionController extends Controller
{
    /**
     * @Route("/acties", name="action_index")
     */
    public function indexAction(
        Request $request,
        ProductPriceService $productPriceService
    ) {

        dump($productPriceService->getActionProducts());

        return $this->render('actions/index.html.twig', []);
    }
}
