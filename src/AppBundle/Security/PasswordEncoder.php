<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class PasswordEncoder
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param string $password
     * @return string
     */
    public function encodePassword($password)
    {
        $encoder = $this->encoderFactory->getEncoder(User::class);

        // salt is deprecated for bcrypt, so we pass an empty string
        return $encoder->encodePassword($password, '');
    }
}
