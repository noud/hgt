<?php

namespace AppBundle\Service;

use AppBundle\Repository\StaticBlockRepository;

class StaticBlockService
{
    /**
     * @var StaticBlockRepository
     */
    private $staticBlockRepository;

    /**
     * StaticBlockService constructor.
     * @param StaticBlockRepository $staticBlockRepository
     */
    public function __construct(StaticBlockRepository $staticBlockRepository)
    {
        $this->staticBlockRepository = $staticBlockRepository;
    }
}