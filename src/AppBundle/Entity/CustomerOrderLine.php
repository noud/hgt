<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerOrderLineRepository")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CustomerOrder", inversedBy="customer_order_line")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="customer_order_line")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UnitOfMeasure", inversedBy="customer_order_line")
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
