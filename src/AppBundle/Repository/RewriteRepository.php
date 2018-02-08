<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Rewrite;
use Doctrine\ORM\EntityRepository;

class RewriteRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Rewrite
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
