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
}
