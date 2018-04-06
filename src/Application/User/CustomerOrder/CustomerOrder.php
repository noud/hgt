<?php

namespace HGT\Application\User\CustomerOrder;

use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\CustomerOrder\CustomerOrderRepository")
 * @ORM\Table(name="customer_order")
 */
class CustomerOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerGroup\CustomerGroup", inversedBy="customer_order")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_group;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $order_number;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $delivery_address;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $delivery_city;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $order_reference;

    /**
     * @var DateTime
     * @ORM\Column(type="date")
     */
    private $order_date;

    /**
     * @var DateTime
     * @ORM\Column(type="date", nullable=true, options={"default":NULL})
     */
    private $delivery_date;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_product_count;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $total_price;

    /**
     * @var CustomerOrderLine
     * @ORM\OneToMany(targetEntity="HGT\Application\User\CustomerOrder\CustomerOrderLine", mappedBy="customer_order")
     */
    private $customer_order_lines;

    public function __construct()
    {
        $this->customer_order_lines = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|CustomerOrderLine
     */
    public function getCustomerOrderLines()
    {
        return $this->customer_order_lines;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCustomerGroup()
    {
        return $this->customer_group;
    }

    /**
     * @param mixed $customer_group
     */
    public function setCustomerGroup($customer_group)
    {
        $this->customer_group = $customer_group;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->order_number;
    }

    /**
     * @param string $order_number
     */
    public function setOrderNumber($order_number)
    {
        $this->order_number = $order_number;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->delivery_address;
    }

    /**
     * @param string $delivery_address
     */
    public function setDeliveryAddress($delivery_address)
    {
        $this->delivery_address = $delivery_address;
    }

    /**
     * @return string
     */
    public function getDeliveryCity()
    {
        return $this->delivery_city;
    }

    /**
     * @param string $delivery_city
     */
    public function setDeliveryCity($delivery_city)
    {
        $this->delivery_city = $delivery_city;
    }

    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->order_reference;
    }

    /**
     * @param string $order_reference
     */
    public function setOrderReference($order_reference)
    {
        $this->order_reference = $order_reference;
    }

    /**
     * @return DateTime
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /**
     * @param DateTime $order_date
     */
    public function setOrderDate($order_date)
    {
        $this->order_date = $order_date;
    }

    /**
     * @return DateTime
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
    }

    /**
     * @param DateTime $delivery_date
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->delivery_date = $delivery_date;
    }

    /**
     * @return int
     */
    public function getTotalProductCount()
    {
        return $this->total_product_count;
    }

    /**
     * @param int $total_product_count
     */
    public function setTotalProductCount($total_product_count)
    {
        $this->total_product_count = $total_product_count;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * @param float $total_price
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
    }
}
