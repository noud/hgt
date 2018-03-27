<?php

namespace HGT\Application\User\Query;

use DateTimeImmutable;

class IsAccountLockedQuery
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
