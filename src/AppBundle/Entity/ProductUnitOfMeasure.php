<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductUnitOfMeasureRepository")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="product_unit_of_measure")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UnitOfMeasure", inversedBy="product_category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_of_measure;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $selected;
}
