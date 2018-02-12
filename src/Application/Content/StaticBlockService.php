<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\StaticBlock\StaticBlockRepository;

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
