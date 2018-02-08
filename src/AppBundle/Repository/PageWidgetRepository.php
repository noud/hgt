<?php

namespace AppBundle\Repository;

use AppBundle\Entity\PageWidget;
use Doctrine\ORM\EntityRepository;

class PageWidgetRepository extends EntityRepository
{
    /**
     * @param $id
     * @return PageWidget
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param PageWidget $pageWidget
     */
    public function add(PageWidget $pageWidget)
    {
        $this->getEntityManager()->persist($pageWidget);
    }

    /**
     * @param PageWidget $pageWidget
     */
    public function remove(PageWidget $pageWidget)
    {
        $this->getEntityManager()->remove($pageWidget);
    }
}