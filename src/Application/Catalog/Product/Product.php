<?php

namespace HGT\Application\Catalog\Product;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use HGT\Application\Catalog\Category\Category;
use HGT\Application\Catalog\Manufacture\Manufacturer;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Product\ProductRepository")
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
     * @var PersistentCollection
     * @ORM\ManyToMany(targetEntity="HGT\Application\Catalog\Category\Category")
     * @ORM\JoinTable(name="product_category",
     *     joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     *     )
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Manufacture\Manufacturer", inversedBy="product")
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\ProductPicture", inversedBy="product")
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
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\ProductTaxGroup", inversedBy="product")
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

    /**
     * @return Category|null
     */
    public function getCategory()
    {
        if ($this->category->count() === 0) {
            return null;
        }

        return $this->category->first();
    }

    /**
     * @return Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @return mixed
     */
    public function getMainPicture()
    {
        return $this->main_picture;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getProductTaxGroup()
    {
        return $this->product_tax_group;
    }
}
