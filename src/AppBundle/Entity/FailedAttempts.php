<?php

namespace AppBundle\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FailedAttemptsRepository")
 */
class FailedAttempts
{
    const NUMBER_OF_ALLOWED_FAILURES = 5;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $username;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime")
     */
    private $lastFailure;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $numberOfFailures;

    /**
     * @param string $username
     * @param DateTimeImmutable $lastFailure
     */
    public function __construct($username, DateTimeImmutable $lastFailure)
    {
        $this->username = $username;
        $this->lastFailure = $lastFailure;
        $this->numberOfFailures = 1;
    }

    /**
     * @param DateTimeImmutable $lastFailure
     */
    public function addFailure(DateTimeImmutable $lastFailure)
    {
        $this->lastFailure = $lastFailure;
        $this->numberOfFailures += 1;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return bool
     */
    public function isTooMany()
    {
        return $this->numberOfFailures > self::NUMBER_OF_ALLOWED_FAILURES;
    }
}
