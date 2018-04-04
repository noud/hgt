<?php

namespace HGT\Application\Catalog\Product;

use Doctrine\Common\Collections\ArrayCollection;
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
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Manufacture\Manufacturer")
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\ProductPicture", fetch="EAGER")
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
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\ProductTaxGroup")
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
     * @var ArrayCollection|ProductPrice[]
     *
     * @ORM\OneToMany(targetEntity="HGT\Application\Catalog\Product\ProductPrice", mappedBy="product")
     */
    private $productPrices;

    /**
     * @var ArrayCollection|ProductUnitOfMeasure[]
     *
     * @ORM\OneToMany(targetEntity="HGT\Application\Catalog\Product\ProductUnitOfMeasure", mappedBy="product")
     */
    private $productUnitOfMeasures;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->productPrices = new ArrayCollection();
        $this->productUnitOfMeasures = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|ProductPrice[]
     */
    public function getProductPrices()
    {
        return $this->productPrices;
    }

    /**
     * @return ProductPrice|mixed|null
     */
    public function getLowestProductPrice()
    {
        /** @var ProductPrice|null $lowestProductPrice */
        $lowestProductPrice = $this->getProductPrices();


        dump($lowestProductPrice);



//
//        foreach ($this->getProductPrices() as $productPrice) {
//            if ($productPrice->getUnitPrice() < $lowestProductPrice->getUnitPrice()) {
//                $lowestProductPrice = $productPrice;
//            }
//        }



        return $lowestProductPrice;
    }

    /**
     * @return ArrayCollection|ProductUnitOfMeasure[]
     */
    public function getProductUnitOfMeasures()
    {
        return $this->productUnitOfMeasures;
    }

    /**
     * @param ArrayCollection|ProductUnitOfMeasure[] $productUnitOfMeasure
     */
    public function setProductUnitOfMeasures($productUnitOfMeasures)
    {
        $this->productUnitOfMeasures = $productUnitOfMeasures;
    }

    /**
     * @param ArrayCollection|ProductPrice[] $productPrices
     */
    public function setProductPrices($productPrices)
    {
        $this->productPrices = $productPrices;
    }

    /**
     * @return Category|null
     */
    public function getCategory()
    {
        if ($this->categories->count() === 0) {
            return null;
        }

        return $this->categories->first();
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

    /**
     * @return bool
     */
    public function isOrderProduct()
    {
        return $this->is_order_product;
    }

    /**
     * @return mixed
     */
    public function getMailOrderToSupplier()
    {
        return $this->mail_order_to_supplier;
    }
}
