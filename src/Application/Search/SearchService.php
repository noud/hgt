<?php

namespace HGT\Application\Search;

use HGT\AppBundle\Repository\Catalog\Manufacture\ManufacturerRepository;
use HGT\Application\Catalog\ManufacturerService;
use HGT\Application\Catalog\ProductService;
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
     * @var ProductService
     */
    private $productService;

    /**
     * SearchService constructor.
     */
    public function __construct(NewsService $newsService, ManufacturerService $manufacturerService, ProductService $productService)
    {
        $this->newsService = $newsService;
        $this->manufacturerService = $manufacturerService;
        $this->productService = $productService;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function searchAllStuff($query)
    {
        $searchResults['products'] = $this->productService->searchProducts($query);
        $searchResults['news'] = $this->newsService->searchNews($query);
        $searchResults['manufacturers'] = $this->manufacturerService->searchManufacturers($query);

        return $searchResults;
    }
}
