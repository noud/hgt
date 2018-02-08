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

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Manufacturer", inversedBy="product")
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductPicture", inversedBy="product")
     */
    private $main_picture;

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

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Manufacturer", inversedBy="product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_tax_group;

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
