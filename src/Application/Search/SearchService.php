<?php

namespace HGT\Application\Search;

use HGT\AppBundle\Repository\Catalog\Manufacture\ManufacturerRepository;
use HGT\Application\Catalog\ManufacturerService;
use HGT\Application\Content\NewsService;

class SearchService
{
    /**
     * @var NewsService
     */
    private $newsService;

    /**
     * @var ManufacturerService
     */
    private $manufacturerService;

    /**
     * SearchService constructor.
     */
    public function __construct(NewsService $newsService, ManufacturerService $manufacturerService)
    {
        $this->newsService = $newsService;
        $this->manufacturerService = $manufacturerService;
    }

    public function getSearchNews($skeet)
    {
        return $this->newsService->searchNews($skeet);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function searchAllStuff($query)
    {
        $searchResults['news'] = $this->newsService->searchNews($query);
        $searchResults['manufacturers'] = $this->manufacturerService->searchManufacturers($query);

        return $searchResults;
    }
}
