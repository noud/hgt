<?php

namespace HGT\Application\User\Event;

use DateTimeImmutable;

class FailedAttemptEvent
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var DateTimeImmutable
     */
    public $timestamp;
}
