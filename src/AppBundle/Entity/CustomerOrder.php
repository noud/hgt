<?php

namespace AppBundle\Entity;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CustomerOrderRepository")
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


    //@TODO: customer_group_id > customer_group.id


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
     * @ORM\Column(type="integer")
     */
    private $total_product_count;

    /**
     * @ORM\Column(type="float", precision=2)
     */
    private $total_price;
}
