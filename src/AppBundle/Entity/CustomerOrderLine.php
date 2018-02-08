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


    //@TODO: customer_order_id > customer_order.id


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


    //@TODO: product_id > product.id


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


    //@TODO: unit_of_measure_id > unit_of_measeure.id


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
