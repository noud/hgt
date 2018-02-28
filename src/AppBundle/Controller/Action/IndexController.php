<?php

namespace HGT\AppBundle\Controller\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/acties", name="action_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('actions/index.html.twig');
    }
}
