<?php

namespace AppBundle\Controller\Account;

use AppBundle\Form\Account\PasswordForgottenForm;
use AppBundle\Service\PasswordResetService;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PasswordResetController extends Controller
{
    /**
     * @var PasswordResetService
     */
    private $passwordResetService;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * PasswordResetController constructor.
     * @param PasswordResetService $passwordResetService
     * @param EntityManager $entityManager
     */
    public function __construct(PasswordResetService $passwordResetService, EntityManager $entityManager)
    {
        $this->passwordResetService = $passwordResetService;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/wachtwoord-vergeten", name="account_password_forgotten")
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function passwordForgottenAction(Request $request)
    {
        $form = $this->createForm(PasswordForgottenForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->get('account_username')->getData();

            $this->passwordResetService->sendPasswordResetLink($username);
            $this->entityManager->flush();

            return $this->redirectToRoute('account_password_forgotten_sent');
        }

        return $this->render('account/password-forgotten.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/wachtwoord-vergeten/verzonden", name="account_password_forgotten_sent")
     */
    public function passwordForgottenSentAction(Request $request)
    {
        return $this->render('account/password-forgotten-sent.html.twig');
    }

    /**
     * @param Request $request
     * @Route("/wachtwoord-vergeten/reset/{hash}", name="account_password_reset")
     */
    public function passwordResetAction($hash, Request $request)
    {
        die('passwordResetAction: ' . $hash);
    }
}
