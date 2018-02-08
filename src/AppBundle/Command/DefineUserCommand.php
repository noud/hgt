<?php

namespace AppBundle\Command;

use Symfony\Component\Validator\Constraints as Assert;

class DefineUserCommand
{
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
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[0-9])\S*$/",
     *     message="Je wachtwoord moet bestaan uit minimaal 8 tekens, één hoofdletter, één kleine letter en één cijfer."
     * )
     * @var string
     */
    public $password = null;
}
