<?php

namespace HGT\AppBundle\PasswordReset;

use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class RandomPasswordGenerator
{
    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;

    /**
     * RandomPasswordGenerator constructor.
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(TokenGeneratorInterface $tokenGenerator)
    {
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * @return string
     */
    public function generatePassword($length = 10)
    {
        $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        return substr($token, 0, $length);
    }
}
