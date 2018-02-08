<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Page;
use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Page
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Page $page
     */
    public function add(Page $page)
    {
        $this->getEntityManager()->persist($page);
    }

    /**
     * @param Page $page
     */
    public function remove(Page $page)
    {
        $this->getEntityManager()->remove($page);
    }
}
