<?php

namespace AppBundle\Security;

use AppBundle\Entity\Customer;
use AppBundle\Form\Account\LoginForm;
use AppBundle\Service\CustomerService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var CustomerService
     */
    private $customerService;
    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * LoginFormAuthenticator constructor.
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param CustomerService $customerService
     * @param PasswordEncoder $passwordEncoder
     * @param EntityManager $entityManager
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        CustomerService $customerService,
        PasswordEncoder $passwordEncoder,
        EntityManager $entityManager
    ) {
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->customerService = $customerService;
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }

    /**
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->router->generate('account_login');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCredentials(Request $request)
    {
        $isLoginSubmit = ($request->get('_route') === 'account_login' && $request->isMethod('POST'));

        if (!$isLoginSubmit) {
            // skip authentication
            return;
        }

        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);
        $data = $form->getData();

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['account_username']
        );

        return $data;
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return null|UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $user = $this->customerService->getCustomerByUsername($credentials['account_username']);

        if (null === $user) {
            throw new UsernameNotFoundException();
        }

        return $user;
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['account_password'];

        if ($user instanceof Customer && null === $user->getPassword()) {
            /** @var Customer $customer */
            $customer = $user;

            if ($this->passwordEncoder->isOldPasswordValid($user, $password)) {
                $this->customerService->updatePassword($customer->getId(), $password);
                $this->entityManager->flush();

                return true;
            }

            return false;
        }

        return $this->passwordEncoder->isPasswordValid($user, $password);
    }

    /**
     * @return string
     */
    public function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('homepage');
    }
}
