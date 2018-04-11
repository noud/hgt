<?php

namespace HGT\Application\User\CustomerGroup;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use HGT\Application\User\Customer\Customer;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\CmsUser\CustomerGroup\CustomerGroupRepository")
 * @ORM\Table(name="customer_group")
 */
class CustomerGroup
{
    /**
     * @var int
     *
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

    /**
     * @var Customer
     * @ORM\OneToMany(targetEntity="HGT\Application\User\Customer\Customer", mappedBy="customer_group")
     */
    private $customers;

    /**
     * CustomerGroup constructor.
     */
    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

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

    /**
     * @return Customer
     */
    public function getCustomers()
    {
        return $this->customers;
    }
}
