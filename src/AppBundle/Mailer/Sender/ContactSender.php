<?php

namespace HGT\AppBundle\Mailer\Sender;

class ContactSender
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
     * @param $contactCommand
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendContactMessage($contactCommand)
    {
        $subject = 'Contactbericht HGT';
        $body = $this->mailer->render('emails/contact/message.html.twig', [
            'contact' => $contactCommand
        ]);

        //create message
        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        $message->addTo($contactCommand->email, $contactCommand->name);
        $message->setReplyTo($contactCommand->email, $contactCommand->name);
        $this->mailer->send($message);
    }
}
