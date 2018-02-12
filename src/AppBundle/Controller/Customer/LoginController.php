<?php

namespace HGT\AppBundle\Controller\Customer;

use HGT\AppBundle\Form\Customer\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * LoginController constructor.
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(AuthenticationUtils $authenticationUtils)
    {
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @Route("/inloggen", name="account_login")
     */
    public function loginAction()
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(LoginForm::class, [
            'account_username' => $this->authenticationUtils->getLastUsername()
        ]);

        return $this->render('account/login.html.twig', array(
            'form' => $form->createView(),
            'error' => $error
        ));
    }
}
