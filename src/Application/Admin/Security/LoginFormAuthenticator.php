<?php
namespace HGT\Application\Admin\Security;

use HGT\AppBundle\Repository\User\User\CmsUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\RouterInterface;
use HGT\AppBundle\Form\Admin\Security\LoginForm;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class LoginFormAuthenticator
 * @package AppBundle\Security
 */
class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CmsUserRepository
     */
    private $userRepository;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * LoginFormAuthenticator constructor.
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param CmsUserRepository $userRepository
     * @param RouterInterface $router
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param SessionInterface $session
     */
    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface $formFactory, CmsUserRepository $userRepository, RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->userRepository = $userRepository;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }

    /**
     * @param Request $request
     * @return mixed|null|void
     */
    public function getCredentials(Request $request)
    {
        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);

        $data = $form->getData();

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['_username']
        );
        return $data;
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return \AppBundle\Entity\Contact|null|object|UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];

        return $this->userRepository->getUserByEmail($username);
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     * @param Request $request
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];

        return $this->passwordEncoder->isPasswordValid($user, $password);
    }

    /**
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->router->generate('security_cms_login');
    }

    /**
     * @return string
     */
    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('easyadmin');
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request) {
        return $request->getPathInfo() === '/admin/login' && $request->isMethod('POST');
    }
}