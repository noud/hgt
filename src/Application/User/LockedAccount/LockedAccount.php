<?php

namespace HGT\Application\User\LockedAccount;

use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\LockedAccount\LockedAccountRepository")
 */
class LockedAccount
{
    const DURATION_ACTIVE = 'PT30M';

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
    private $lockedSince;

    /**
     * @param string $username
     * @param DateTimeImmutable $lockedSince
     */
    public function __construct($username, DateTimeImmutable $lockedSince)
    {
        $this->username = $username;
        $this->lockedSince = $lockedSince;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param DateTimeImmutable $now
     * @return bool
     */
    public function isActiveAt(DateTimeImmutable $now)
    {
        $lockedUntil = $this->lockedSince->add(new DateInterval(self::DURATION_ACTIVE));

        return $now < $lockedUntil;
    }
}
