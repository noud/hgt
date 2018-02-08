<?php

namespace AppBundle\Repository;

use AppBundle\Entity\SelectionCode;
use Doctrine\ORM\EntityRepository;

class SelectionCodeRepository extends EntityRepository
{
    /**
     * @param $id
     * @return SelectionCode
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param SelectionCode $selectionCode
     */
    public function add(SelectionCode $selectionCode)
    {
        $this->getEntityManager()->persist($selectionCode);
    }

    /**
     * @param SelectionCode $selectionCode
     */
    public function remove(SelectionCode $selectionCode)
    {
        $this->getEntityManager()->remove($selectionCode);
    }
}
