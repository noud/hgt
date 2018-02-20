<?php

namespace HGT\AppBundle\Controller\Customer;

use HGT\AppBundle\Form\Signup\SignupForm;
use HGT\AppBundle\Mailer\Sender\SignupSender;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Signup\Command\SignupCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SignupController extends Controller
{
    /**
     * @Route("/aanmelden", name="account_signup")
     *
     * @param Request $request
     * @param SignupSender $signupSender
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(Request $request, SignupSender $signupSender)
    {

        $command = new SignupCommand();
        $form = $this->createForm(SignupForm::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $signupSender->sendContactMessage($command);
            return $this->redirectToRoute('account_signup_confirm');
        }

        return $this->render('signup/index.html.twig',[
            'testing' =>$command,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/aanmelden/bedankt", name="account_signup_confirm")
     */
    public function confirmAction()
    {
        return $this->render('signup/confirm.html.twig');
    }
}
