<?php

namespace HGT\AppBundle\Controller\Customer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    /**
     * @Route("/mijn-account", name="account_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('account/order-history.html.twig', [
        ]);
    }

    /**
     * @throws \Exception
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached');
    }
}
