<?php

namespace HGT\Application\User\Query;

use DateTimeImmutable;

class IsAccountLockedQuery
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
