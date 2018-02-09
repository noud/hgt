<?php

namespace HGT\AppBundle\Repository\Content\Widget;

use Doctrine\ORM\EntityRepository;
use HTG\Application\Content\Widget\Widget;

class WidgetRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Widget|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Widget $widget
     */
    public function add(Widget $widget)
    {
        $this->getEntityManager()->persist($widget);
    }

    /**
     * @param Widget $widget
     */
    public function remove(Widget $widget)
    {
        $this->getEntityManager()->remove($widget);
    }
}
