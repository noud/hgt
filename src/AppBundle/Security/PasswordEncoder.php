<?php

namespace AppBundle\Security;

use AppBundle\Entity\Customer;
use Nelmio\Alice\Instances\Populator\Methods\Custom;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordEncoder
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var string
     */
    private $salt;

    /**
     * @param EncoderFactoryInterface $encoderFactory
     * @param string $salt
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, $salt)
    {
        $this->encoderFactory = $encoderFactory;
        $this->salt = $salt;
    }

    /**
     * @param string $password
     * @return string
     */
    public function encodePassword($password)
    {
        $encoder = $this->encoderFactory->getEncoder(Customer::class);

        // salt is deprecated for bcrypt, so we pass an empty string
        return $encoder->encodePassword($password, '');
    }

    /**
     * @param UserInterface $user
     * @param $raw
     *
     * @return bool
     */
    public function isPasswordValid(UserInterface $user, $raw)
    {
        $encoder = $this->encoderFactory->getEncoder($user);

        return $encoder->isPasswordValid($user->getPassword(), $raw, $user->getSalt());
    }

    /**
     * @param Customer $customer
     * @param $raw
     *
     * @return bool
     */
    public function isOldPasswordValid(Customer $customer, $raw)
    {
        $hash = hash_hmac('sha1', $raw, $this->salt);
        return hash_equals($hash, $customer->getOldPassword());
    }
}
