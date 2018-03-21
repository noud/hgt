<?php

namespace HGT\AppBundle\Repository\Content\Rewrite;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\Rewrite\Rewrite;

class RewriteRepository extends ServiceEntityRepository
{
    /**
     * RewriteRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rewrite::class);
    }

    /**
     * @param $id
     * @return Rewrite|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Rewrite $rewrite
     */
    public function add(Rewrite $rewrite)
    {
        $this->getEntityManager()->persist($rewrite);
    }

    /**
     * @param Rewrite $rewrite
     */
    public function remove(Rewrite $rewrite)
    {
        $this->getEntityManager()->remove($rewrite);
    }
}
