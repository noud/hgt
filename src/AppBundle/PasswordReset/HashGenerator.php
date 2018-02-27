<?php

namespace HGT\AppBundle\PasswordReset;

interface HashGenerator
{
    /**
     * @return string
     */
    public function generateHash();
}
