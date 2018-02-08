<?php

namespace AppBundle\PasswordResetHash;

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
