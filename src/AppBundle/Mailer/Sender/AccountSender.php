<?php

namespace AppBundle\Mailer\Sender;

use AppBundle\Mailer\Customer\PasswordResetLink;

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
        $body = $this->mailer->render('emails/customer/password-reset-link.html.twig', array(
            'data' => $passwordForgottenLink
        ));

        //create message
        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        $message->addTo($passwordForgottenLink->email, $passwordForgottenLink->name);
        $this->mailer->send($message);
    }
}
