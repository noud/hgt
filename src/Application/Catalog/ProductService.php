<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductRepository;
use HGT\Application\Catalog\Category\Category;
use HGT\Application\Catalog\Product\Product;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var TaxService
     */
    private $taxService;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     * @param TaxService $taxService
     */
    public function __construct(ProductRepository $productRepository, TaxService $taxService)
    {
        $this->productRepository = $productRepository;
        $this->taxService = $taxService;
    }

    /**
     * @param int $id
     * @return Product|object
     */
    public function getProductById($id)
    {
        return $this->productRepository->get($id);
    }

    /**
     * @param $query
     * @return Product[]
     */
    public function searchProducts($query)
    {
        return $this->productRepository->searchProducts($query);
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @param $query
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    public function getPagedProducts($currentPage, $perPage, $query)
    {
        return $this->productRepository->getPagedProducts($currentPage, $perPage, $query);
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @param Category $category
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    public function getPagedCategoryProducts($currentPage, $perPage, Category $category)
    {
        return $this->productRepository->getPagedCategoryProducts($currentPage, $perPage, $category);
    }

    /**
     * @param bool $loggedIn
     * @return mixed
     */
    public function getActionProducts($loggedIn = false)
    {
        return $this->productRepository->getActionProducts($loggedIn);
    }

}
