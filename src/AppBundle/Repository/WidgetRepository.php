<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Widget;
use Doctrine\ORM\EntityRepository;

class WidgetRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Widget
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
