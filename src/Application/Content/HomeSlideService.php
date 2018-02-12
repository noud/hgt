<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Home\HomeSlideRepository;

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

    public function getHomeSlides()
    {
        return $this->homeSlideRepository->getAll();
    }
}
