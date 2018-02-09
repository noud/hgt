<?php

namespace HGT\AppBundle\PasswordReset;

use DateTimeImmutable;

class NativeDateTimeGenerator implements DateTimeGenerator
{
    /**
     * @return DateTimeImmutable
     */
    public function now()
    {
        return new DateTimeImmutable();
    }
}
