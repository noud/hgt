<?php

namespace HGT\Application\User;

use DateTimeImmutable;
use HGT\AppBundle\Repository\User\FailedAttempts\FailedAttemptsRepository;
use HGT\AppBundle\Repository\User\LockedAccount\LockedAccountRepository;
use HGT\Application\User\Event\FailedAttemptEvent;
use HGT\Application\User\Event\PasswordResetEvent;
use HGT\Application\User\Event\SuccessfulLoginEvent;
use HGT\Application\User\FailedAttempts\FailedAttempts;
use HGT\Application\User\LockedAccount\LockedAccount;
use HGT\Application\User\Query\IsAccountLockedQuery;

class LockingService
{
    /**
     * @var FailedAttemptsRepository
     */
    private $failedAttemptsRepository;

    /**
     * @var LockedAccountRepository
     */
    private $lockedAccountRepository;

    /**
     * LockingService constructor.
     *
     * @param FailedAttemptsRepository $failedAttemptsRepository
     * @param LockedAccountRepository $lockedAccountRepository
     */
    public function __construct(
        FailedAttemptsRepository $failedAttemptsRepository,
        LockedAccountRepository $lockedAccountRepository
    ) {
        $this->failedAttemptsRepository = $failedAttemptsRepository;
        $this->lockedAccountRepository  = $lockedAccountRepository;
    }

    /**
     * @param FailedAttemptEvent $event
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     */
    public function handleFailedAttempt(FailedAttemptEvent $event)
    {
        $failedAttempts = $this->failedAttemptsRepository->findByIp($event->ip);

        if ($failedAttempts === null) {
            $failedAttempts = new FailedAttempts($event->ip, $event->timestamp);

            $this->failedAttemptsRepository->add($failedAttempts);
        } else {
            $failedAttempts->addFailure($event->timestamp);
        }

        if ($failedAttempts->isTooMany()) {
            $this->lockAccount($event->ip, $event->timestamp);
        }
    }

    /**
     * @param IsAccountLockedQuery $query
     * @return bool
     * @throws \Exception
     */
    public function isAccountLockedAt(IsAccountLockedQuery $query)
    {
        $lockedAccount = $this->lockedAccountRepository->findByIp($query->ip);

        if ($lockedAccount === null) {
            return false;
        }

        return $lockedAccount->isActiveAt($query->timestamp);
    }

    /**
     * @param string $ipAddress
     * @param DateTimeImmutable $timestamp
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     */
    private function lockAccount($ipAddress, DateTimeImmutable $timestamp)
    {
        $lockedAccount = $this->lockedAccountRepository->findByIp($ipAddress);

        if ($lockedAccount === null) {
            $lockedAccount = new LockedAccount($ipAddress, $timestamp);

            $this->lockedAccountRepository->add($lockedAccount);
        }
    }

    /**
     * @param $ipAddress
     */
    private function resetAttemptsAndLockedAccountForIpAddress($ipAddress)
    {
        $this->lockedAccountRepository->removeByIp($ipAddress);
        $this->failedAttemptsRepository->removeByIp($ipAddress);
    }

    /**
     * @param SuccessfulLoginEvent $event
     */
    public function handleSuccessfulLogin(SuccessfulLoginEvent $event)
    {
        $this->resetAttemptsAndLockedAccountForIpAddress($event->ip);
    }

    /**
     * @param PasswordResetEvent $event
     */
    public function handlePasswordReset(PasswordResetEvent $event)
    {
        $this->resetAttemptsAndLockedAccountForIpAddress($event->ip);
    }
}
