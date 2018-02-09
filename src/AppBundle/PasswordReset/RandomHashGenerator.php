<?php

namespace HGT\AppBundle\PasswordReset;

class RandomHashGenerator implements HashGenerator
{
    /**
     * @return string
     */
    public function generateHash()
    {
        return bin2hex(random_bytes(16));
    }
}
