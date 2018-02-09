<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\Product;

class ProductRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Product|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Product $product
     */
    public function add(Product $product)
    {
        $this->getEntityManager()->persist($product);
    }

    /**
     * @param Product $product
     */
    public function remove(Product $product)
    {
        $this->getEntityManager()->remove($product);
    }
}
