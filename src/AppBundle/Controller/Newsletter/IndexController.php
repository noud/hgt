<?php

namespace HGT\AppBundle\Controller\Newsletter;

use HGT\Application\Content\NewsletterService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @var NewsletterService
     */
    private $newsletterService;

    /**
     * IndexController constructor.
     * @param NewsletterService $newsletterService
     */
    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    /**
     * @Route("/newsletter/subscribe", name="newsletter_subscribe")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function subscribeAction(Request $request)
    {
        $referer = $request->headers->get('referer');

        if (!$this->checkValidEmail($request->get('email'))) {
            $this->addFlash('danger', 'Vul een (geldig) e-mailadres in.');
            return $this->redirect($referer);
        } else {
            $subscribe = $this->newsletterService->listSubscribe(
                $this->getParameter('mailchimp_list_id'), $request->get('email')
            );

            if ($subscribe['status'] == 400) {
                $this->addFlash('danger', 'Dit e-mailadres is al aangemeld voor de nieuwsbrief.');
                return $this->redirect($referer);
            } else {
                return $this->redirectToRoute('newsletter_success');
            }
        }
    }

    /**
     * @Route("/newsletter/success", name="newsletter_success")
     * @return string
     */
    public function successAction()
    {
        return $this->render('newsletter/success.html.twig');
    }

    /**
     * @param $emailAddress
     * @return bool
     */
    private function checkValidEmail($emailAddress)
    {
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        return preg_match($regex, $emailAddress);
    }
}
