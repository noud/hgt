<?php

namespace HGT\Application\User\Event;

use DateTimeImmutable;

class PasswordResetEvent
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
