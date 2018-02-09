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
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerOrder\CustomerOrder", inversedBy="customer_order_line")
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
}
