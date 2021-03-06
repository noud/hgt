<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Selection\SelectionCodeRepository;

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
