<?php

namespace AppBundle\Service;

use AppBundle\Repository\NewsRepository;

class NewsService
{
    /**
     * @var NewsRepository
     */
    private $newsRepository;

    /**
     * NewsService constructor.
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
}