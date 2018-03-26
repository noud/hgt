<?php

namespace HGT\Application\User\Customer;

interface PasswordResetListener
{
    /**
     * @param string $ip
     */
    public function onPasswordReset($ip);
}
