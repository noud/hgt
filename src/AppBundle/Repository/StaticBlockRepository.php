<?php

namespace AppBundle\Repository;

use AppBundle\Entity\StaticBlock;
use Doctrine\ORM\EntityRepository;

class StaticBlockRepository extends EntityRepository
{
    /**
     * @param $id
     * @return StaticBlock
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param StaticBlock $staticBlock
     */
    public function add(StaticBlock $staticBlock)
    {
        $this->getEntityManager()->persist($staticBlock);
    }

    /**
     * @param StaticBlock $staticBlock
     */
    public function remove(StaticBlock $staticBlock)
    {
        $this->getEntityManager()->remove($staticBlock);
    }
}