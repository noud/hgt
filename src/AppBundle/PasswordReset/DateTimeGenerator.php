<?php

namespace AppBundle\PasswordReset;

use DateTimeImmutable;

interface DateTimeGenerator
{
    /**
     * @return DateTimeImmutable
     */
    public function now();
}
