<?php

namespace AppBundle\Entity;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductPriceRepository")
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


    //@TODO; product_id > product.id
    //@TODO: customer_price_group_id > customer_price_group.id
    //@TODO: customer_group_id > customer_group.id
    //@TODO: unit_of_measure_id > unit_of_measure.id


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


    //@TODO: selection_code_id > selection_code.id


}
