<?php

namespace HGT\AppBundle\Repository\Content\Page;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\Page\PageStaticBlock;

class PageStaticBlockRepository extends ServiceEntityRepository
{
    /**
     * PageStaticBlockRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageStaticBlock::class);
    }

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
