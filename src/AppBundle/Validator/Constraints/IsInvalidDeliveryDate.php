<?php

namespace HGT\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsInvalidDeliveryDate extends Constraint
{
    public $message = '';
}
