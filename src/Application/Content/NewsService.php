<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\News\NewsRepository;
use HGT\Application\Content\News\News;

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

    /**
     * @param $id
     * @return News|null|object
     */
    public function getNewsById($id)
    {
        return $this->newsRepository->getNewsById($id);
    }

    /**
     * @return News[]
     */
    public function getActiveNews()
    {
        return $this->newsRepository->getActiveNews();
    }

    /**
     * @param $query
     * @return News[]
     */
    public function searchNews($query)
    {
        return $this->newsRepository->searchNews($query);
    }
}
