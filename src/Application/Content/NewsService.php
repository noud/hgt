<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\News\NewsRepository;

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
