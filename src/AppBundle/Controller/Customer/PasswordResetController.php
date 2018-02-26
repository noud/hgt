<?php

namespace HGT\AppBundle\Controller\Customer;

use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Form\Customer\PasswordForgottenForm;
use HGT\Application\User\PasswordResetService;
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
     * @Route("/wachtwoord-vergeten/reset/{hash}", name="account_password_reset")
     * @param $hash
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function passwordResetAction($hash, Request $request)
    {
        $isValid = $this->passwordResetService->isValidHash($hash);

        if (!$isValid) {
            $this->addFlash(
                'error',
                'De link is verlopen, vul je gebruikersnaam opnieuw in om een nieuwe link aan te vragen.'
            );
            return $this->redirectToRoute('account_password_forgotten');
        }

        if (!$this->passwordResetService->resetPassword($hash)) {
            $this->addFlash(
                'error',
                'Het is niet gelukt om je wachtwoord te resetten.'
            );
            return $this->redirectToRoute('account_password_forgotten');
        }

        $this->entityManager->flush();
        return $this->redirectToRoute('account_password_new_password_sent');
    }

    /**
     * @Route("/wachtwoord-vergeten/nieuw-wachtwoord-verzonden", name="account_password_new_password_sent")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newPasswordSentAction()
    {
        return $this->render('account/password-new-password-sent.html.twig');
    }
}
