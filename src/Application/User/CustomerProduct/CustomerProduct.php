<?php

namespace HGT\Application\User\CustomerProduct;

use Doctrine\ORM\Mapping as ORM;
use HGT\Application\Catalog\Product\UnitOfMeasure;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\CustomerProduct\CustomerProductRepository")
 * @ORM\Table(name="customer_product")
 */
class CustomerProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerGroup\CustomerGroup", inversedBy="customer_product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_group;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\Product", inversedBy="customer_product")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\UnitOfMeasure", inversedBy="customer_product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_of_measure;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $volume;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $search_name;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $priority;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $qty_per_unit_of_measure;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCustomerGroup()
    {
        return $this->customer_group;
    }

    /**
     * @param mixed $customer_group
     */
    public function setCustomerGroup($customer_group)
    {
        $this->customer_group = $customer_group;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return UnitOfMeasure
     */
    public function getUnitOfMeasure()
    {
        return $this->unit_of_measure;
    }

    /**
     * @param UnitOfMeasure $unit_of_measure
     */
    public function setUnitOfMeasure(UnitOfMeasure $unit_of_measure)
    {
        $this->unit_of_measure = $unit_of_measure;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param string $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return string
     */
    public function getSearchName()
    {
        return $this->search_name;
    }

    /**
     * @param string $search_name
     */
    public function setSearchName($search_name)
    {
        $this->search_name = $search_name;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return float
     */
    public function getQtyPerUnitOfMeasure()
    {
        return $this->qty_per_unit_of_measure;
    }

    /**
     * @param float $qty_per_unit_of_measure
     */
    public function setQtyPerUnitOfMeasure($qty_per_unit_of_measure)
    {
        $this->qty_per_unit_of_measure = $qty_per_unit_of_measure;
    }
}
