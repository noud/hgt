<?php

namespace HGT\Application\User\LockedAccount;

use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\CmsUser\LockedAccount\LockedAccountRepository")
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
    private $ipAddress;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime")
     */
    private $lockedSince;

    /**
     * @param string $ipAddress
     * @param DateTimeImmutable $lockedSince
     */
    public function __construct($ipAddress, DateTimeImmutable $lockedSince)
    {
        $this->ipAddress = $ipAddress;
        $this->lockedSince = $lockedSince;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param DateTimeImmutable $now
     * @return bool
     * @throws \Exception
     */
    public function isActiveAt(DateTimeImmutable $now)
    {
        $lockedUntil = $this->lockedSince->add(new DateInterval(self::DURATION_ACTIVE));

        return $now < $lockedUntil;
    }
}
