<?php

namespace HGT\Application\User\CustomerOrder;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\CustomerOrder\CustomerOrderLineRepository")
 * @ORM\Table(name="customer_order_line")
 */
class CustomerOrderLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerOrder\CustomerOrder", inversedBy="customer_order_lines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_order;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $line_no;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $line_type;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\Product", inversedBy="customer_order_line")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $product;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $brand;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $volume;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $qty;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\UnitOfMeasure", inversedBy="customer_order_line")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_of_measure;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $unit_price;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $is_action;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $total_price;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCustomerOrder()
    {
        return $this->customer_order;
    }

    /**
     * @param mixed $customer_order
     */
    public function setCustomerOrder($customer_order)
    {
        $this->customer_order = $customer_order;
    }

    /**
     * @return string
     */
    public function getLineNo()
    {
        return $this->line_no;
    }

    /**
     * @param string $line_no
     */
    public function setLineNo($line_no)
    {
        $this->line_no = $line_no;
    }

    /**
     * @return string
     */
    public function getLineType()
    {
        return $this->line_type;
    }

    /**
     * @param string $line_type
     */
    public function setLineType($line_type)
    {
        $this->line_type = $line_type;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param string $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return float
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param float $qty
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return mixed
     */
    public function getUnitOfMeasure()
    {
        return $this->unit_of_measure;
    }

    /**
     * @param mixed $unit_of_measure
     */
    public function setUnitOfMeasure($unit_of_measure)
    {
        $this->unit_of_measure = $unit_of_measure;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * @param float $unit_price
     */
    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;
    }

    /**
     * @return bool
     */
    public function isAction()
    {
        return $this->is_action;
    }

    /**
     * @param bool $is_action
     */
    public function setIsAction($is_action)
    {
        $this->is_action = $is_action;
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
