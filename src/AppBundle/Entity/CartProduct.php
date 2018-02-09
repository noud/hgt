<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CartRepository")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cart", inversedBy="cart_product")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $cart;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="cart_product")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UnitOfMeasure", inversedBy="cart_product")
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
}
