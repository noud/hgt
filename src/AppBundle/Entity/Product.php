<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;


    //@TODO: manufacturer_id > manufacturer.id
    //@TODO: main_picture_id > product_picture.id


    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $navision_id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     */
    private $short_description;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $volume;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $price;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":1})
     */
    private $enabled;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $url_key;


    //@TODO: product_tax_group_id > product_tax_group.id


    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $is_order_product;

    /**
     * @ORM\Column(type="string")
     */
    private $mail_order_to_supplier;
}
