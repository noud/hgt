<?php

namespace AppBundle\PasswordResetHash;

use DateTimeImmutable;

interface DateTimeGenerator
{
    /**
     * @return DateTimeImmutable
     */
    public function now();
}
