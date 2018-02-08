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


    //@TODO: product_id > product.id


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


    //@TODO: unit_of_measure_id > unit_of_measure.id


    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $selected;
}
