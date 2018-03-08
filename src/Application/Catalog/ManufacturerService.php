<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Manufacture\ManufacturerRepository;
use HGT\Application\Catalog\Manufacture\Manufacturer;

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
     * @return Manufacturer[]
     */
    public function getManufacturers()
    {
        return $this->manufacturerRepository->getManufacturers();
    }

    /**
     * @return Manufacturer[]
     */
    public function getManufacturersWithProducts()
    {
        return $this->manufacturerRepository->getManufacturersWithProducts();
    }
}
