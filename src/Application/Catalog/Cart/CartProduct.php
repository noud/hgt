<?php

namespace HGT\Application\Catalog\Cart;

use Doctrine\ORM\Mapping as ORM;
use HGT\Application\Catalog\Product\Product;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Cart\CartProductRepository")
 * @ORM\Table(name="cart_product")
 */
class CartProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Cart\Cart", inversedBy="cart_product")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $cart;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\Product", inversedBy="cart_product")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\UnitOfMeasure", inversedBy="cart_product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_of_measure;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $unit_price;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $qty;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $tax_percentage;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $is_action;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param mixed $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return Product
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
     * @return float
     */
    public function getTaxPercentage()
    {
        return $this->tax_percentage;
    }

    /**
     * @param float $tax_percentage
     */
    public function setTaxPercentage($tax_percentage)
    {
        $this->tax_percentage = $tax_percentage;
    }

    /**
     * @param bool $is_action
     */
    public function setIsAction($is_action)
    {
        $this->is_action = $is_action;
    }

    /**
     * @return float|int
     */
    public function getRowTotal()
    {
        return $this->getQty() * $this->getUnitPrice();
    }
}
