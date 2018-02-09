<?php

namespace AppBundle\Service;

use AppBundle\Mailer\Customer\NewPassword;
use AppBundle\Mailer\Customer\PasswordResetLink;
use AppBundle\Mailer\Sender\AccountSender;
use AppBundle\PasswordReset\RandomPasswordGenerator;

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
     * @var RandomPasswordGenerator
     */
    private $randomPasswordGenerator;

    /**
     * PasswordResetService constructor.
     * @param AccountSender $accountSender
     * @param CustomerService $customerService
     * @param PasswordResetHashService $passwordResetHashService
     * @param RandomPasswordGenerator $randomPasswordGenerator
     */
    public function __construct(
        AccountSender $accountSender,
        CustomerService $customerService,
        PasswordResetHashService $passwordResetHashService,
        RandomPasswordGenerator $randomPasswordGenerator
    ) {
        $this->accountSender = $accountSender;
        $this->customerService = $customerService;
        $this->passwordResetHashService = $passwordResetHashService;
        $this->randomPasswordGenerator = $randomPasswordGenerator;
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

        if (!$customer) {
            return false;
        }

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
    public function resetPassword($hash)
    {
        // 1. Find customer
        $username = $this->passwordResetHashService->get($hash);
        $customer = $this->customerService->getCustomerByUsername($username);

        if (!$customer) {
            return false;
        }

        // 2. Generate new password
        $newPassword = $this->randomPasswordGenerator->generatePassword();

        // 3. Add the new password to the customer
        $this->customerService->updatePassword($customer->getId(), $newPassword);

        // 5. Send new password email to the customer
        $newPasswordData = new NewPassword();
        $newPasswordData->name = $customer->getName();
        $newPasswordData->email = $customer->getEmail();
        $newPasswordData->username = $username;
        $newPasswordData->password = $newPassword;

        $this->accountSender->sendNewPassword($newPasswordData);

        // 6. Clear all password reset hashes
        $this->passwordResetHashService->makeAllUserHashesInvalid($username);

        return true;
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
