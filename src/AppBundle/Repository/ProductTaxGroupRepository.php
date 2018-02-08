<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ProductTaxGroup;
use Doctrine\ORM\EntityRepository;

class ProductTaxGroupRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductTaxGroup
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param ProductTaxGroup $productTaxGroup
     */
    public function add(ProductTaxGroup $productTaxGroup)
    {
        $this->getEntityManager()->persist($productTaxGroup);
    }

    /**
     * @param ProductTaxGroup $productTaxGroup
     */
    public function remove(ProductTaxGroup $productTaxGroup)
    {
        $this->getEntityManager()->remove($productTaxGroup);
    }
}