<?php

namespace AppBundle\PasswordResetHash;

interface HashGenerator
{
    /**
     * @return string
     */
    public function generateHash();
}
