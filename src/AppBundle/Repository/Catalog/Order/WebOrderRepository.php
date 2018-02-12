<?php

namespace HGT\AppBundle\Repository\Catalog\Order;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Order\WebOrder;

class WebOrderRepository extends EntityRepository
{
    /**
     * @param $id
     * @return WebOrder|object
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
