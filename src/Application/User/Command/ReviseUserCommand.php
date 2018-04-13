<?php

namespace HGT\Application\User\Command;

use HGT\Application\User\User\CmsUser;

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
    public function __construct(CmsUser $user)
    {
        $this->id = $user->getId();
        $this->email = $user->getEmail();
        $this->name = $user->getName();
    }
}
