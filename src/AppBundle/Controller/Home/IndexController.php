<?php

namespace HGT\AppBundle\Controller\Home;

use HGT\Application\User\CustomerService;
use HGT\Application\User\PasswordResetService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
    }


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('index/index.html.twig');
    }
}
