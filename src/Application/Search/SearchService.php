<?php

namespace HGT\Application\Search;

use Doctrine\ORM\Tools\Pagination\Paginator;
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
    public function __construct(
        NewsService $newsService,
        ManufacturerService $manufacturerService,
        ProductService $productService
    ) {
        $this->newsService = $newsService;
        $this->manufacturerService = $manufacturerService;
        $this->productService = $productService;
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @param $query
     * @return Paginator
     */
    public function getPagedProducts($currentPage, $perPage, $query)
    {
        return $this->productService->getPagedProducts($currentPage, $perPage, $query);
    }

    /**
     * @param $query
     * @return \HGT\Application\Content\News\News[]
     */
    public function searchNews($query)
    {
        return $this->newsService->searchNews($query);
    }

    /**
     * @param $query
     * @return \HGT\Application\Catalog\Manufacture\Manufacturer[]
     */
    public function searchManufacturers($query)
    {
        return $this->manufacturerService->searchManufacturers($query);
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @param $query
     * @return array
     */
    public function searchAll($currentPage, $perPage, $query)
    {
        return [
            'products' => $this->getPagedProducts($currentPage, $perPage, $query),
            'news' => $this->searchNews($query),
            'manufacturers' => $this->searchManufacturers($query)
        ];
    }
}
