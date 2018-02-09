<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\ProductPrice;

class ProductPriceRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductPrice|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param ProductPrice $productPrice
     */
    public function add(ProductPrice $productPrice)
    {
        $this->getEntityManager()->persist($productPrice);
    }

    /**
     * @param ProductPrice $productPrice
     */
    public function remove(ProductPrice $productPrice)
    {
        $this->getEntityManager()->remove($productPrice);
    }
}
