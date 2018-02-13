<?php

namespace HGT\AppBundle\Controller\Catalog;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @Route("/product/view/{id}", name="product_view")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, Request $request)
    {
        return $this->render('catalog/product/view.html.twig', [
            'id' => $id,
        ]);
    }
}
