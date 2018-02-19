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
     */
    public function handleFailedAttempt(FailedAttemptEvent $event)
    {
        $failedAttempts = $this->failedAttemptsRepository->findByUsername($event->username);

        if ($failedAttempts === null) {
            $failedAttempts = new FailedAttempts($event->username, $event->timestamp);

            $this->failedAttemptsRepository->add($failedAttempts);
        } else {
            $failedAttempts->addFailure($event->timestamp);
        }

        if ($failedAttempts->isTooMany()) {
            $this->lockAccount($event->username, $event->timestamp);
        }
    }

    /**
     * @param IsAccountLockedQuery $query
     * @return bool
     */
    public function isAccountLockedAt(IsAccountLockedQuery $query)
    {
        $lockedAccount = $this->lockedAccountRepository->findByUsername($query->username);

        if ($lockedAccount === null) {
            return false;
        }

        return $lockedAccount->isActiveAt($query->timestamp);
    }

    /**
     * @param string $username
     * @param DateTimeImmutable $timestamp
     */
    private function lockAccount($username, DateTimeImmutable $timestamp)
    {
        $lockedAccount = $this->lockedAccountRepository->findByUsername($username);

        if ($lockedAccount === null) {
            $lockedAccount = new LockedAccount($username, $timestamp);

            $this->lockedAccountRepository->add($lockedAccount);
        }
    }

    private function resetAttemptsAndLockedAccountForUsername($username)
    {
        $this->lockedAccountRepository->removeByUsername($username);
        $this->failedAttemptsRepository->removeByUsername($username);
    }

    /**
     * @param SuccessfulLoginEvent $event
     */
    public function handleSuccessfulLogin(SuccessfulLoginEvent $event)
    {
        $this->resetAttemptsAndLockedAccountForUsername($event->username);
    }

    /**
     * @param PasswordResetEvent $event
     */
    public function handlePasswordReset(PasswordResetEvent $event)
    {
        $this->resetAttemptsAndLockedAccountForUsername($event->username);
    }
}
