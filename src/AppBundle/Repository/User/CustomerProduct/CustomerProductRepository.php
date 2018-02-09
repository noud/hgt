<?php

namespace HGT\AppBundle\Repository\User\CustomerProduct;

use Doctrine\ORM\EntityRepository;
use HGT\Application\User\CustomerProduct\CustomerProduct;

class CustomerProductRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerProduct|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerProduct $customerProduct
     */
    public function add(CustomerProduct $customerProduct)
    {
        $this->getEntityManager()->persist($customerProduct);
    }

    /**
     * @param CustomerProduct $customerProduct
     */
    public function remove(CustomerProduct $customerProduct)
    {
        $this->getEntityManager()->remove($customerProduct);
    }
}
