<?php

namespace HGT\AppBundle\Repository\Content\StaticBlock;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\StaticBlock\StaticBlock;

class StaticBlockRepository extends EntityRepository
{
    /**
     * @param $id
     * @return StaticBlock|object
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

    /**
     * @param $identifier
     * @return StaticBlock|object
     */
    public function getByIdentifier($identifier)
    {
        return $this->findOneBy([
            'identifier' => $identifier,
        ]);
    }
}
