<?php

namespace HGT\Application\Signup\Command;

use Symfony\Component\Validator\Constraints as Assert;

class SignupCommand
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $companyName;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $companyNumber;

    /**
     * @var string
     */
    public $gender;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $contactPerson;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $phone;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $mobile;


    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $address;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $postal;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $place;


    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @var string
     */
    public $email;

    /**
     * @var boolean
     */
    public $profit;
}
