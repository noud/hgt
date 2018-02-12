<?php

namespace HGT\Application\Catalog\Manufacture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Manufacture\ManufacturerRepository")
 * @ORM\Table(name="manufacturer")
 */
class Manufacturer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, options={"default":NULL})
     */
    private $navision_brand;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $url_key;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $total_product_count;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $picture;
}
