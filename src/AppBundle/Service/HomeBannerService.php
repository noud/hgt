<?php

namespace AppBundle\Service;

use AppBundle\Repository\HomeBannerRepository;

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
}