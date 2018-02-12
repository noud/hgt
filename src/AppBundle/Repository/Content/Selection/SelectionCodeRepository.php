<?php

namespace HGT\AppBundle\Repository\Content\Selection;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\SelectionCode\SelectionCode;

class SelectionCodeRepository extends EntityRepository
{
    /**
     * @param $id
     * @return SelectionCode|object
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
