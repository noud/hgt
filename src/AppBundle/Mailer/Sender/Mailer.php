<?php

namespace HGT\AppBundle\Mailer\Sender;

use Swift_Mailer;
use Swift_Message;
use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;

class Mailer
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var string
     */
    private $defaultFromEmail;

    /**
     * @var string
     */
    private $defaultFromName;

    /**
     * @param Swift_Mailer $mailer
     * @param Twig_Environment $twig
     * @param string $defaultFromEmail
     * @param string $defaultFromName
     */
    public function __construct(Swift_Mailer $mailer, Twig_Environment $twig, $defaultFromEmail= '', $defaultFromName = '')
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->defaultFromEmail = $defaultFromEmail;
        $this->defaultFromName = $defaultFromName;
    }

    /**
     * Renders a template.
     *
     * @param string $name    The template name
     * @param array  $context An array of parameters to pass to the template
     *
     * @return string The rendered template
     *
     * @throws Twig_Error_Loader  When the template cannot be found
     * @throws Twig_Error_Syntax  When an error occurred during compilation
     * @throws Twig_Error_Runtime When an error occurred during rendering
     */
    public function render($name, array $context = array())
    {
        return $this->twig->render($name, $context);
    }

    /**
     * Send the given Message like it would be sent in a mail client.
     *
     * All recipients (with the exception of Bcc) will be able to see the other
     * recipients this message was sent to.
     *
     * Recipient/sender data will be retrieved from the Message object.
     *
     * The return value is the number of recipients who were accepted for
     * delivery.
     *
     * @param Swift_Message $message
     *
     * @return int
     */
    public function send(Swift_Message $message)
    {
        return $this->mailer->send($message);
    }

    /**
     * Create a new Message.
     *
     * Details may be optionally passed into the constructor.
     *
     * @param string $subject
     * @param string $body
     * @param string $contentType
     * @param string $charset
     *
     * @return Swift_Message The message
     */
    public function createMessage($subject = null, $body = null, $contentType = null, $charset = null)
    {
        $message = new Swift_Message($subject, $body, $contentType, $charset);
        $message->setFrom($this->defaultFromEmail, $this->defaultFromName);
        return $message;
    }
}
