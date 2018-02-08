<?php

namespace AppBundle\Service;

use AppBundle\Repository\HomeSlideRepository;

class HomeSlideService
{
    /**
     * @var HomeSlideRepository
     */
    private $homeSlideRepository;

    /**
     * HomeSlideService constructor.
     * @param HomeSlideRepository $homeSlideRepository
     */
    public function __construct(HomeSlideRepository $homeSlideRepository)
    {
        $this->homeSlideRepository = $homeSlideRepository;
    }
}