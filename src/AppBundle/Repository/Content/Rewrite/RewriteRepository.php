<?php

namespace HGT\AppBundle\Repository\Content\Rewrite;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Rewrite\Rewrite;

class RewriteRepository extends EntityRepository
{
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
