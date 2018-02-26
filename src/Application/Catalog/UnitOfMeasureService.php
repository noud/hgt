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

    /**
     * @param $unit_of_measure_id
     * @return Product\UnitOfMeasure|object
     */
    public function getUnitOfMeasureById($unit_of_measure_id)
    {
        return $this->unitOfMeasureRepository->get($unit_of_measure_id);
    }
}
