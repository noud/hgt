<?php

namespace HGT\AppBundle\Security\Account;

use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use HGT\Application\User\Customer\PasswordResetListener;
use HGT\Application\User\Event\FailedAttemptEvent;
use HGT\Application\User\Event\PasswordResetEvent;
use HGT\Application\User\Event\SuccessfulLoginEvent;
use HGT\Application\User\LockingService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;

class AccountLockingListener implements EventSubscriberInterface, PasswordResetListener
{
    /**
     * @var LockingService
     */
    private $lockingService;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AccountLockingListener constructor.
     *
     * @param LockingService $lockingService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(LockingService $lockingService, EntityManagerInterface $entityManager)
    {
        $this->lockingService = $lockingService;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AuthenticationEvents::AUTHENTICATION_FAILURE => array('onAuthenticationFailure', 1)
        );
    }

    /**
     * @param AuthenticationFailureEvent $authenticationEvent
     */
    public function onAuthenticationFailure(AuthenticationFailureEvent $authenticationEvent)
    {
        $credentials = $authenticationEvent->getAuthenticationToken()->getCredentials();
        $username = isset($credentials['account_username']) ? $credentials['account_username'] : false;

        $event = new FailedAttemptEvent();
        $event->username = $username;
        $event->timestamp = new DateTimeImmutable();

        $this->lockingService->handleFailedAttempt($event);
        $this->entityManager->flush();
    }

    /**
     * @param string $username
     */
    public function onPasswordReset($username)
    {
        $event = new PasswordResetEvent();
        $event->username = $username;
        $event->timestamp = new DateTimeImmutable();

        $this->lockingService->handlePasswordReset($event);
        $this->entityManager->flush();
    }
}
