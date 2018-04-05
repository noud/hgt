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
     * @param $query
     * @return Manufacturer[]
     */
    public function searchManufacturers($query)
    {
        return $this->manufacturerRepository->searchManufacturers($query);
    }

    /**
     * @return Manufacturer[]
     */
    public function getManufacturersWithProducts()
    {
        return $this->manufacturerRepository->getManufacturersWithProducts();
    }

    /**
     * @return array
     */
    public function getManufacturerLetterIndex()
    {
        $manufacturerCats = array();

        $manufacturersObjects = $this->getManufacturersWithProducts();

        foreach ($manufacturersObjects as $manufacturersObject) {
            $indexLetter = $manufacturersObject->getIndexLetter();

            if (!isset($manufacturerCats[$indexLetter])) {
                $manufacturerCats[$indexLetter] = [];
            }

            $manufacturerCats[$indexLetter][] = $manufacturersObject;
        }

        return $manufacturerCats;
    }

    /**
     * @param $name
     * @return array
     */
    public function getManufacturerMerkIndex($name)
    {
        $manufacturerProds = array();

        $manufacturersObjects = $this->manufacturerRepository->getManufacturerProducts($name);

        foreach ($manufacturersObjects as $manufacturersObject) {
            $manufacturerProds[] = $manufacturersObject;
            //$manufacturerProds[]['urlKey'] = '/merk' . $manufacturersObject['name'];
        }
        //dump($manufacturerProds);
        return $manufacturerProds;
    }
}
