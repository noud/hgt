<?php

namespace HGT\AppBundle\Repository\Content\Page;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Page\PageStaticBlock;

class PageStaticBlockRepository extends EntityRepository
{
    /**
     * @param $id
     * @return PageStaticBlock|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param PageStaticBlock $pageStaticBlock
     */
    public function add(PageStaticBlock $pageStaticBlock)
    {
        $this->getEntityManager()->persist($pageStaticBlock);
    }

    /**
     * @param PageStaticBlock $pageStaticBlock
     */
    public function remove(PageStaticBlock $pageStaticBlock)
    {
        $this->getEntityManager()->remove($pageStaticBlock);
    }
}
