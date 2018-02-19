<?php

namespace HGT\Application\User\Customer;

interface PasswordResetListener
{
    /**
     * @param string $username
     */
    public function onPasswordReset($username);
}
