<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ProductPrice;
use Doctrine\ORM\EntityRepository;

class ProductPriceRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductPrice
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