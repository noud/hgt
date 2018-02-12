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

    /**
     * @param $limit
     * @return Home\HomeBanner[]
     */
    public function getHomeBanners($limit = 3)
    {
        return $this->homeBannerRepository->getHomeBanners($limit);
    }
}
