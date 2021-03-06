<?php

namespace HGT\Application\User\CustomerDiscountGroup;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\CustomerDiscountGroup\CustomerDiscountGroupRepository")
 * @ORM\Table(name="customer_discount_group")
 */
class CustomerDiscountGroup
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $navision_id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNavisionId()
    {
        return $this->navision_id;
    }
}
