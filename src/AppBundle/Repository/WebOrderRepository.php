<?php

namespace AppBundle\Repository;

use AppBundle\Entity\WebOrder;
use Doctrine\ORM\EntityRepository;

class WebOrderRepository extends EntityRepository
{
    /**
     * @param $id
     * @return WebOrder
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param WebOrder $webOrder
     */
    public function add(WebOrder $webOrder)
    {
        $this->getEntityManager()->persist($webOrder);
    }

    /**
     * @param WebOrder $webOrder
     */
    public function remove(WebOrder $webOrder)
    {
        $this->getEntityManager()->remove($webOrder);
    }
}
