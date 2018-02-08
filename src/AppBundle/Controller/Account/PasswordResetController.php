<?php

namespace AppBundle\Controller\Account;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PasswordResetController extends Controller
{
    /**
     * @Route("/wachtwoord-vergeten", name="account_password_forgotten")
     */
    public function passwordForgottenAction()
    {
        die('PasswordResetController');
    }
}
