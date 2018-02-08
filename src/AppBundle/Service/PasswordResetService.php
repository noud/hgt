<?php

namespace AppBundle\Service;

use AppBundle\Mailer\Customer\PasswordResetLink;
use AppBundle\Mailer\Sender\AccountSender;

class PasswordResetService
{
    /**
     * @var AccountSender
     */
    private $accountSender;

    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * @var PasswordResetHashService
     */
    private $passwordResetHashService;

    /**
     * PasswordResetService constructor.
     * @param AccountSender $accountSender
     * @param CustomerService $customerService
     * @param PasswordResetHashService $passwordResetHashService
     */
    public function __construct(
        AccountSender $accountSender,
        CustomerService $customerService,
        PasswordResetHashService $passwordResetHashService
    ) {
        $this->accountSender = $accountSender;
        $this->customerService = $customerService;
        $this->passwordResetHashService = $passwordResetHashService;
    }

    /**
     * @param $username
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendPasswordResetLink($username)
    {
        $customer = $this->customerService->getCustomerByUsername($username);

        $hash = $this->passwordResetHashService->generateHash($username, 'PT1H');

        $resetLink = new PasswordResetLink();
        $resetLink->name = $customer->getName();
        $resetLink->email = $customer->getEmail();
        $resetLink->username = $username;
        $resetLink->hash = $hash;

        $this->accountSender->sendPasswordResetLink($resetLink);
    }

    /**
     * @param string $hash
     * @param string $password
     */
    public function resetPassword($hash, $password)
    {
        $username = $this->passwordResetHashService->get($hash);
        $customer = $this->customerService->getCustomerByUsername($username);

        if (is_object($customer)) {
            $customer->setPassword($password);
            $this->passwordResetHashService->makeAllUserHashesInvalid($username);
        }
    }

    /**
     * @param string $hash
     * @return bool
     */
    public function isValidHash($hash)
    {
        return $this->passwordResetHashService->validate($hash);
    }
}
