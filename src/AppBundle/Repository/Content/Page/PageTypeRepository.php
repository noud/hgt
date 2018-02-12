<?php

namespace HGT\AppBundle\Repository\Content\Page;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Page\PageType;

class PageTypeRepository extends EntityRepository
{
    /**
     * @param $id
     * @return PageType|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param PageType $pageType
     */
    public function add(PageType $pageType)
    {
        $this->getEntityManager()->persist($pageType);
    }

    /**
     * @param PageType $pageType
     */
    public function remove(PageType $pageType)
    {
        $this->getEntityManager()->remove($pageType);
    }
}
