<?php

namespace HGT\Application\Catalog\Product;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use HGT\Application\Content\SelectionCode\SelectionCode;
use HGT\Application\User\CustomerGroup\CustomerGroup;
use HGT\Application\User\CustomerPriceGroup\CustomerPriceGroup;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Product\ProductPriceRepository")
 * @ORM\Table(name="product_price")
 */
class ProductPrice
{
    const PRICE_TYPE_GLOBAL = 'global';
    const PRICE_TYPE_CUSTOMER_PRICE_GROUP = 'customer_price_group';
    const PRICE_TYPE_CUSTOMER_GROUP = 'customer_group';
    const PRICE_TYPE_SELECTION = 'selection';

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
     * @var Product
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\Product", inversedBy="productPrices")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @var CustomerPriceGroup
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerPriceGroup\CustomerPriceGroup")
     */
    private $customer_price_group;

    /**
     * @var CustomerGroup
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerGroup\CustomerGroup")
     */
    private $customer_group;

    /**
     * @var UnitOfMeasure
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\UnitOfMeasure")
     */
    private $unit_of_measure;

    /**
     * @var DateTime
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @var DateTime
     * @ORM\Column(type="date", nullable=true, options={"default":NULL})
     */
    private $end_date;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $unit_price;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $minimum_qty;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $is_action_price;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $price_type;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $is_web_action;

    /**
     * @var SelectionCode
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\SelectionCode\SelectionCode")
     */
    private $selection_code;

    /**
     * @return CustomerPriceGroup
     */
    public function getCustomerPriceGroup()
    {
        return $this->customer_price_group;
    }

    /**
     * @return CustomerGroup
     */
    public function getCustomerGroup()
    {
        return $this->customer_group;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * @return float
     */
    public function getMinimumQty()
    {
        return $this->minimum_qty;
    }

    /**
     * @return SelectionCode
     */
    public function getSelectionCode()
    {
        return $this->selection_code;
    }

    /**
     * @return string
     */
    public function getPriceType()
    {
        return $this->price_type;
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
     * @param string $navision_id
     */
    public function setNavisionId($navision_id)
    {
        $this->navision_id = $navision_id;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return UnitOfMeasure
     */
    public function getUnitOfMeasure()
    {
        return $this->unit_of_measure;
    }

    /**
     * @param $unit_of_measure
     */
    public function setUnitOfMeasure($unit_of_measure)
    {
        $this->unit_of_measure = $unit_of_measure;
    }

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param DateTime $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param DateTime $end_date
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }

    /**
     * @return bool
     */
    public function isActionPrice()
    {
        return $this->is_action_price;
    }

    /**
     * @param bool $is_action_price
     */
    public function setIsActionPrice($is_action_price)
    {
        $this->is_action_price = $is_action_price;
    }

    /**
     * @return bool
     */
    public function isWebAction()
    {
        return $this->is_web_action;
    }

    /**
     * @param bool $is_web_action
     */
    public function setIsWebAction($is_web_action)
    {
        $this->is_web_action = $is_web_action;
    }
}
