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
     * @return Manufacture\Manufacturer[]
     */
    public function getManufacturers()
    {
        return $this->manufacturerRepository->getManufacturers();
    }

    /**
     * @return Manufacture\Manufacturer[]
     */
    public function getManufacturersWithProducts()
    {
        return $this->manufacturerRepository->getManufacturersWithProducts();
    }
}
