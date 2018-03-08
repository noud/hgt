<?php

namespace HGT\AppBundle\Controller\Dummy;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/dummy", name="dummy_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('dummy/account/order.html.twig');
    }
}
