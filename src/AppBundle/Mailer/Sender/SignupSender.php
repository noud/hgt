<?php

namespace HGT\AppBundle\Mailer\Sender;

use HGT\Application\Signup\Command\SignupCommand;

class SignupSender
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
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendContactMessage($command)
    {
        $subject = 'Aanmelding HGT';
        $body = $this->mailer->render('emails/customer/signup.html.twig', [
            'command' => $command
        ]);

        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        $message->addTo($command->email, $command->contactPerson);
        $message->setReplyTo($command->email, $command->contactPerson);
        $this->mailer->send($message);
    }
}
