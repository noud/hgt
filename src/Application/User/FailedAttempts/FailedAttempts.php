<?php

namespace HGT\Application\User\FailedAttempts;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\FailedAttempts\FailedAttemptsRepository")
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
    private $ipAddress;

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
     * @param string $ipAddress
     * @param DateTimeImmutable $lastFailure
     */
    public function __construct($ipAddress, DateTimeImmutable $lastFailure)
    {
        $this->ipAddress = $ipAddress;
        $this->lastFailure = $lastFailure;
        $this->numberOfFailures = 1;
    }

    /**
     * @param DateTimeImmutable $lastFailure
     */
    public function addFailure(DateTimeImmutable $lastFailure)
    {
        $this->lastFailure = $lastFailure;
        ++$this->numberOfFailures;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @return bool
     */
    public function isTooMany()
    {
        return $this->numberOfFailures > self::NUMBER_OF_ALLOWED_FAILURES;
    }
}
