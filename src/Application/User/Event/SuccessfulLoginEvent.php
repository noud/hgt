<?php

namespace HGT\Application\User\Event;

use DateTimeImmutable;

class SuccessfulLoginEvent
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
