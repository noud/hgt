<?php

namespace AppBundle\PasswordReset;

interface HashGenerator
{
    /**
     * @return string
     */
    public function generateHash();
}
