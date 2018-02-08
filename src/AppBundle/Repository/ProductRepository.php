<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Product
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
