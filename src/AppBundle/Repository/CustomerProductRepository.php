<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CustomerProduct;
use Doctrine\ORM\EntityRepository;

class CustomerProductRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerProduct
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
