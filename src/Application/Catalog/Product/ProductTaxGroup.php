<?php

namespace HGT\Application\Catalog\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Product\ProductTaxGroupRepository")
 * @ORM\Table(name="product_tax_group")
 */
class ProductTaxGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $navision_id;
}
