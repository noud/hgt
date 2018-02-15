<?php

namespace HGT\Application\User\Event;

use DateTimeImmutable;

class SuccessfulLoginEvent
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
