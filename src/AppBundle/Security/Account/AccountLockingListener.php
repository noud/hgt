<?php

namespace HGT\AppBundle\Security\Account;

use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use HGT\Application\User\Customer\PasswordResetListener;
use HGT\Application\User\Event\FailedAttemptEvent;
use HGT\Application\User\Event\PasswordResetEvent;
use HGT\Application\User\LockingService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\AuthenticationEvents;
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
     * @var RequestStack
     */
    private $requestStack;
    /**
     * AccountLockingListener constructor.
     *
     * @param LockingService $lockingService
     * @param EntityManagerInterface $entityManager
     * @param RequestStack $requestStack
     */
    public function __construct(LockingService $lockingService, EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->lockingService = $lockingService;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
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
        $ip = $this->requestStack->getMasterRequest()->getClientIp();

        $event = new FailedAttemptEvent();
        $event->ip = $ip;
        $event->timestamp = new DateTimeImmutable();

        $this->lockingService->handleFailedAttempt($event);
        $this->entityManager->flush();
    }

    /**
     * @param string $ip
     */
    public function onPasswordReset($ip)
    {
        $event = new PasswordResetEvent();
        $event->ip = $ip;
        $event->timestamp = new DateTimeImmutable();

        $this->lockingService->handlePasswordReset($event);
        $this->entityManager->flush();
    }
}
