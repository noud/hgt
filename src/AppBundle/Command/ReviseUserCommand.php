<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;

class ReviseUserCommand
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @var string
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $name;

    /**
     * ReviseUserCommand constructor.
     */
    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->email = $user->getEmail();
        $this->name = $user->getName();
    }
}
