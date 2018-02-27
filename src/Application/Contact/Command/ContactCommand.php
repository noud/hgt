<?php

namespace HGT\Application\Contact\Command;

use Symfony\Component\Validator\Constraints as Assert;

class ContactCommand
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $phone;

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
    public $message;
}
