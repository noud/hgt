<?php

namespace HGT\Application\User;

use HGT\AppBundle\Mailer\Customer\NewPassword;
use HGT\AppBundle\Mailer\Customer\PasswordResetLink;
use HGT\AppBundle\Mailer\Sender\AccountSender;
use HGT\AppBundle\PasswordReset\RandomPasswordGenerator;
use HGT\Application\User\Customer\PasswordResetListener;

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
     * @var PasswordResetListener
     */
    private $passwordResetListener;

    /**
     * PasswordResetService constructor.
     *
     * @param AccountSender $accountSender
     * @param CustomerService $customerService
     * @param PasswordResetHashService $passwordResetHashService
     * @param RandomPasswordGenerator $randomPasswordGenerator
     * @param PasswordResetListener $passwordResetListener
     */
    public function __construct(
        AccountSender $accountSender,
        CustomerService $customerService,
        PasswordResetHashService $passwordResetHashService,
        RandomPasswordGenerator $randomPasswordGenerator,
        PasswordResetListener $passwordResetListener
    ) {
        $this->accountSender = $accountSender;
        $this->customerService = $customerService;
        $this->passwordResetHashService = $passwordResetHashService;
        $this->randomPasswordGenerator = $randomPasswordGenerator;
        $this->passwordResetListener = $passwordResetListener;
    }

    /**
     * @param $username
     *
     * @return bool
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
     * @param $ip
     * @return bool
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function resetPassword($hash, $ip)
    {
        // Find customer
        $username = $this->passwordResetHashService->get($hash);
        $customer = $this->customerService->getCustomerByUsername($username);

        if (!$customer) {
            return false;
        }

        // Generate new password
        $newPassword = $this->randomPasswordGenerator->generatePassword();

        // Add the new password to the customer
        $this->customerService->updatePassword($customer->getId(), $newPassword);

        // Send new password email to the customer
        $newPasswordData = new NewPassword();
        $newPasswordData->name = $customer->getName();
        $newPasswordData->email = $customer->getEmail();
        $newPasswordData->username = $username;
        $newPasswordData->password = $newPassword;

        $this->accountSender->sendNewPassword($newPasswordData);

        // Reset login attempts and locked account
        $this->passwordResetListener->onPasswordReset($ip);

        // Clear all password reset hashes
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
