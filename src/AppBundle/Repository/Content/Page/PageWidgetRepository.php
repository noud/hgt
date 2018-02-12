<?php

namespace HGT\AppBundle\Repository\Content\Page;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Page\PageWidget;

class PageWidgetRepository extends EntityRepository
{
    /**
     * @param $id
     * @return PageWidget|object
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
