<?php

namespace AppBundle\Repository;

use AppBundle\Entity\PageType;
use Doctrine\ORM\EntityRepository;

class PageTypeRepository extends EntityRepository
{
    /**
     * @param $id
     * @return PageType
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