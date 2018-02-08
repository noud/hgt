<?php

namespace AppBundle\Service;

use AppBundle\Repository\SelectionCodeRepository;

class SelectionCodeService
{
    /**
     * @var SelectionCodeRepository
     */
    private $selectionCodeRepository;

    /**
     * SelectionCodeService constructor.
     * @param SelectionCodeRepository $selectionCodeRepository
     */
    public function __construct(SelectionCodeRepository $selectionCodeRepository)
    {
        $this->selectionCodeRepository = $selectionCodeRepository;
    }
}