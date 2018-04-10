<?php

namespace HGT\AppBundle\Controller\Contact;

use HGT\AppBundle\Form\Contact\ContactForm;
use HGT\AppBundle\Mailer\Sender\ContactSender;
use HGT\Application\Breadcrumb\BreadcrumbService;
use HGT\Application\Contact\Command\ContactCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact_index")
     * @param Request $request
     * @param ContactSender $contactSender
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(
        Request $request,
        ContactSender $contactSender,
        BreadcrumbService $breadcrumbService
    ) {
        $breadcrumbService->addBreadcrumb('Contact', '');
        $breadcrumbs = $breadcrumbService->getBreadcrumbs();

        $contactCommand = new ContactCommand();
        $form = $this->createForm(ContactForm::class, $contactCommand);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactSender->sendContactMessage($contactCommand);
            return $this->redirectToRoute('contact_confirm');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * @Route("/contact/bedankt", name="contact_confirm")
     */
    public function confirmAction()
    {
        return $this->render('contact/confirm.html.twig');
    }
}
