<?php

namespace HGT\Application\User\Event;

use DateTimeImmutable;

class PasswordResetEvent
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
