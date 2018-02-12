<?php

namespace HGT\Application\User\CustomerGroup;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\CustomerGroup\CustomerGroupRepository")
 * @ORM\Table(name="customer_group")
 */
class CustomerGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=16, options={"comment":"InvoiceDiscountGroup"})
     */
    private $navision_id;
}
