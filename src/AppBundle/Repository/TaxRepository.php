<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Tax;
use Doctrine\ORM\EntityRepository;

class TaxRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Tax
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Tax $tax
     */
    public function add(Tax $tax)
    {
        $this->getEntityManager()->persist($tax);
    }

    /**
     * @param Tax $tax
     */
    public function remove(Tax $tax)
    {
        $this->getEntityManager()->remove($tax);
    }
}
