<?php

namespace HGT\AppBundle\Repository\Content\Page;

use Doctrine\ORM\EntityRepository;
use HTG\Application\Content\Page\Page;

class PageRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Page|object
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
