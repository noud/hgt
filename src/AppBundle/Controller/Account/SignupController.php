<?php

namespace AppBundle\Controller\Account;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SignupController extends Controller
{
    /**
     * @Route("/aanmelden", name="account_signup")
     */
    public function signupAction()
    {
        die('SignupController');
    }
}
