<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductRepository;
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
     * @param Product $product
     * @return Product|object
     */
    public function getProductById(Product $product)
    {
        return $this->productRepository->get($product);
    }

    /**
     * @param $query
     * @return Product[]
     */
    public function searchProducts($query)
    {
        return $this->productRepository->searchProducts($query);
    }

}
