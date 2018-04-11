<?php
namespace HGT\AppBundle\Controller\Admin;

use HGT\AppBundle\Repository\User\User\CmsUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HGT\AppBundle\Form\Admin\Security\LoginForm;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController extends Controller
{
    /**
     * @var CmsUserRepository
     */
    private $userRepository;

    /**
     * SecurityController constructor.
     * @param CmsUserRepository $userRepository
     * @param TranslatorInterface $translator
     */
    public function __construct(CmsUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/admin/login", name="security_cms_login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the contact
        $lastUsername = $authenticationUtils->getLastUsername();
        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername,
        ]);
        return $this->render(
            'admin/security/login.html.twig',
            array(
                // last username entered by the contact
                'form' => $form->createView(),
                'error' => $error,
            )
        );
    }

    /**
     * @Route("/admin/logout", name="security_cms_logout")
     * @throws \Exception
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached!');
    }
}