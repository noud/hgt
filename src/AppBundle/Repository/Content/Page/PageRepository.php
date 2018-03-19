<?php

namespace HGT\AppBundle\Repository\Content\Page;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Page\Page;

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

    /**
     * @param Page $page
     * @return Page[]
     */
    public function getByParentId(Page $page)
    {
        return $this->findBy(
            ['parent' => $page]
        );
    }
}
