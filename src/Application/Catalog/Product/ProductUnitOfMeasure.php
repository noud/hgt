<?php

namespace HGT\Application\Catalog\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Product\ProductUnitOfMeasureRepository")
 * @ORM\Table(name="product_unit_of_measure")
 */
class ProductUnitOfMeasure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\Product", inversedBy="product_unit_of_measure")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=11)
     */
    private $navision_id;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $qty_per_unit_of_measure;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\UnitOfMeasure", fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_of_measure;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $selected;

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
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return UnitOfMeasure
     */
    public function getUnitOfMeasure()
    {
        return $this->unit_of_measure;
    }

    /**
     * @return float
     */
    public function getQtyPerUnitOfMeasure()
    {
        return $this->qty_per_unit_of_measure;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return sprintf('%s (%d)',
            $this->getUnitOfMeasure()->getName(),
            $this->getQtyPerUnitOfMeasure()
        );
    }
}
