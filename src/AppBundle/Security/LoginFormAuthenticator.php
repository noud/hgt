<?php

namespace HGT\AppBundle\Security;

use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Form\Customer\LoginForm;
use HGT\Application\User\Customer\Customer;
use HGT\Application\User\CustomerService;
use HGT\Application\User\Event\SuccessfulLoginEvent;
use HGT\Application\User\LockingService;
use HGT\Application\User\Query\IsAccountLockedQuery;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\LockedException;
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
     * @var LockingService
     */
    private $lockingService;

    /**
     * LoginFormAuthenticator constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param CustomerService $customerService
     * @param PasswordEncoder $passwordEncoder
     * @param EntityManager $entityManager
     * @param LockingService $lockingService
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        CustomerService $customerService,
        PasswordEncoder $passwordEncoder,
        EntityManager $entityManager,
        LockingService $lockingService
    ) {
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->customerService = $customerService;
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
        $this->lockingService = $lockingService;
    }

    /**
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->router->generate('account_login');
    }

    private function isCustomerLocked($username)
    {
        // Check if the user is locked
        $query = new IsAccountLockedQuery();
        $query->username = $username;
        $query->timestamp = new DateTimeImmutable();

        return $this->lockingService->isAccountLockedAt($query);
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
        // Check if the account is locked
        if ($this->isCustomerLocked($credentials['account_username'])) {
            throw new LockedException('Customer account is locked.');
        }

        $password = $credentials['account_password'];
        $success = false;

        if ($user instanceof Customer) {
            /** @var Customer $customer */
            $customer = $user;

            // Check if the account is blocked
            if ($customer->isBlocked()) {
                throw new LockedException('Customer account is blocked.');
            }

            if (null === $user->getPassword()) {
                if ($this->passwordEncoder->isOldPasswordValid($user, $password)) {
                    $this->customerService->updatePassword($customer->getId(), $password);
                    $this->entityManager->flush();

                    $this->onSuccessfulLoginEvent($credentials);
                    return true;
                }

                return false;
            }
        }

        $success = $this->passwordEncoder->isPasswordValid($user, $password);

        if ($success) {
            $this->onSuccessfulLoginEvent($credentials);
        }

        return $success;
    }

    private function onSuccessfulLoginEvent($credentials)
    {
        $event = new SuccessfulLoginEvent();
        $event->username = $credentials['account_username'];
        $event->timestamp = new DateTimeImmutable();

        $this->lockingService->handleSuccessfulLogin($event);
        $this->entityManager->flush();
    }

    /**
     * @return string
     */
    public function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('homepage');
    }
}
