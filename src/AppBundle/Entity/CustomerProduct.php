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


    //@TODO: customer_group_id > customer_group.id
    //@TODO: product_id > product.id
    //@TODO: unit_of_measure_id > unit_of_measure.id


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
