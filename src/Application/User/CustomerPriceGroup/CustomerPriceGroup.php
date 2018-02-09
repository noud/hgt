<?php

namespace HGT\Application\User\CustomerPriceGroup;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\CustomerPriceGroup\CustomerPriceGroupRepository")
 * @ORM\Table(name="customer_price_group")
 */
class CustomerPriceGroup
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

    /**
     * @ORM\Column(type="string")
     */
    private $name;
}
