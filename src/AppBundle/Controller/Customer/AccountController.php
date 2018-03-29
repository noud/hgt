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
        return $this->render('account/account.html.twig', [
        ]);
    }

    /**
     * @Route("/mijn-account/bestellijst", name="account_order_list")
     */
    public function orderListAction(Request $request)
    {
        return $this->render('account/order-list.html.twig', [
        ]);
    }

    /**
     * @Route("/mijn-account/bestellijst-aanpassen", name="account_order_list_edit")
     */
    public function orderListEditAction(Request $request)
    {
        return $this->render('account/order-list-edit.html.twig', [
        ]);
    }

    /**
     * @Route("/mijn-account/bestelhistorie", name="account_order_history")
     */
    public function orderHistoryAction(Request $request)
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
