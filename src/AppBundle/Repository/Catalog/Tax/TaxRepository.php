<?php

namespace HGT\AppBundle\Repository\Catalog\Tax;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Tax\Tax;

class TaxRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Tax|object
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
