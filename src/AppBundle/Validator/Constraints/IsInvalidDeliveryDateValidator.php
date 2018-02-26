<?php

namespace HGT\AppBundle\Validator\Constraints;

use HGT\Application\Catalog\InvalidDeliveryDateService;
use HGT\Application\User\CustomerService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsInvalidDeliveryDateValidator extends ConstraintValidator
{
    /**
     * @var InvalidDeliveryDateService
     */
    private $invalidDeliveryDateService;

    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * IsInvalidDeliveryDateValidator constructor.
     * @param InvalidDeliveryDateService $invalidDeliveryDateService
     * @param CustomerService $customerService
     */
    public function __construct(
        InvalidDeliveryDateService $invalidDeliveryDateService,
        CustomerService $customerService
    ) {
        $this->invalidDeliveryDateService = $invalidDeliveryDateService;
        $this->customerService = $customerService;
    }

    /**
     * @param $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $throwError = false;
        $dateFormatted = $value->format('Y-m-d');

        if ($this->invalidDeliveryDateService->isInvalidDeliveryDateByDate($value)) {
            $throwError = true;
        }

        if (!in_array($dateFormatted, $this->invalidDeliveryDateService->getValidDeliveryDatesAsDateArray())) {
            $weekDay = date("w", strtotime($dateFormatted));
            if (!in_array(
                $weekDay,
                $this->customerService->getValidDeliveryDays($this->customerService->getCurrentCustomer())
            )) {
                $throwError = true;
            }
        }

        if (strtotime($dateFormatted) < time()) {
            $throwError = true;
        }

        if ($throwError) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
