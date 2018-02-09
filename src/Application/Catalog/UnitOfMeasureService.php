<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\UnitOfMeasureRepository;

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
