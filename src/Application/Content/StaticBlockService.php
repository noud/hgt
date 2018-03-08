<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\StaticBlock\StaticBlockRepository;
use HGT\Application\Content\StaticBlock\StaticBlock;

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

    /**
     * @param $identifier
     * @return bool
     */
    public function has($identifier)
    {
        return is_object($this->staticBlockRepository->getByIdentifier($identifier));
    }

    /**
     * @param $identifier
     * @return StaticBlock|null|object
     */
    public function get($identifier)
    {
        return $this->staticBlockRepository->getByIdentifier($identifier);
    }
}
