<?php

namespace HGT\AppBundle\Controller\Dummy;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DummyController extends Controller
{
    /**
     * @Route("/dummy", name="dummy_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('dummy/cart/index.html.twig');
    }
}
