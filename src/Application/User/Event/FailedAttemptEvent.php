<?php

namespace HGT\Application\User\Event;

use DateTimeImmutable;

class FailedAttemptEvent
{
    /**
     * @var string
     */
    public $ip;

    /**
     * @var DateTimeImmutable
     */
    public $timestamp;
}
