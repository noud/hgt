<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Tax\TaxRepository;

class TaxService
{
    /**
     * @var TaxRepository
     */
    private $taxRepository;

    /**
     * TaxService constructor.
     * @param TaxRepository $taxRepository
     */
    public function __construct(TaxRepository $taxRepository)
    {
        $this->taxRepository = $taxRepository;
    }
}
