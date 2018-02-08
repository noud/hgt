<?php

namespace AppBundle\Service;

use AppBundle\Repository\TaxRepository;

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
