<?php

namespace HGT\Application\Catalog\Product;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\Product", inversedBy="product_price")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerPriceGroup\CustomerPriceGroup", inversedBy="product_price")
     */
    private $customer_price_group;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerGroup\CustomerGroup", inversedBy="product_price")
     */
    private $customer_group;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\UnitOfMeasure", inversedBy="product_price")
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
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\SelectionCode\SelectionCode", inversedBy="product_price")
     */
    private $selection_code;
}
