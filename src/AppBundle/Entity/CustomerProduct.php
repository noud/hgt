<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerProductRepository")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CustomerGroup", inversedBy="customer_product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_group;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="customer_product")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UnitOfMeasure", inversedBy="customer_product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_of_measure_id;

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
}
