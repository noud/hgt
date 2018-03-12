<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Manufacture\ManufacturerRepository;

class ManufacturerService
{
    /**
     * @var ManufacturerRepository
     */
    private $manufacturerRepository;

    /**
     * ManufacturerService constructor.
     * @param ManufacturerRepository $manufacturerRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
    }

    /**
     * @param $query
     * @return Manufacture\Manufacturer[]
     */
    public function searchManufacturers($query)
    {
        return $this->manufacturerRepository->searchManufacturers($query);
    }
}
