<?php

namespace AppBundle\Service;

use AppBundle\Repository\UnitOfMeasureRepository;

class UnitOfMeasureService
{
    /**
     * @var UnitOfMeasureRepository
     */
    private $unitOfMeasureRepository;

    /**
     * UnitOfMeasureService constructor.
     * @param UnitOfMeasureRepository $unitOfMeasureRepository
     */
    public function __construct(UnitOfMeasureRepository $unitOfMeasureRepository)
    {
        $this->unitOfMeasureRepository = $unitOfMeasureRepository;
    }
}