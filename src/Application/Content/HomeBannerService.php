<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Home\HomeBannerRepository;

class HomeBannerService
{
    /**
     * @var HomeBannerRepository
     */
    private $homeBannerRepository;

    /**
     * HomeBannerService constructor.
     * @param HomeBannerRepository $homeBannerRepository
     */
    public function __construct(HomeBannerRepository $homeBannerRepository)
    {
        $this->homeBannerRepository = $homeBannerRepository;
    }

    public function getHomeSlides()
    {
        return $this->homeBannerRepository->getAll();
    }
}
