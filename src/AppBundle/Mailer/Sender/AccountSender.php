<?php

namespace HGT\AppBundle\Mailer\Sender;

use HGT\AppBundle\Mailer\Customer\NewPassword;
use HGT\AppBundle\Mailer\Customer\PasswordResetLink;

class AccountSender
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * AccountSender constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param PasswordResetLink $passwordForgottenLink
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendPasswordResetLink(PasswordResetLink $passwordForgottenLink)
    {
        $subject = 'Bevestig wijzigen wachtwoord';
        $body = $this->mailer->render('emails/customer/password-reset-link.html.twig',[]);

        //create message
        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        $message->addTo($passwordForgottenLink->email, $passwordForgottenLink->name);
        $this->mailer->send($message);
    }

    /**
     * @param PasswordResetLink $passwordForgottenLink
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendNewPassword(NewPassword $newPassword)
    {
        $subject = 'Uw nieuwe wachtwoord';
        $body = $this->mailer->render('emails/customer/new-password.html.twig', array(
            'data' => $newPassword
        ));

        //create message
        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        $message->addTo($newPassword->email, $newPassword->name);
        $this->mailer->send($message);
    }
}
