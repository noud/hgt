<?php

namespace HGT\Application\Catalog\Tax;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Tax\TaxRepository")
 * @ORM\Table(name="tax")
 */
class Tax
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\ProductTaxGroup")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_tax_group;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerTaxGroup\CustomerTaxGroup")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_tax_group;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $percentage;

    /**
     * @return float
     */
    public function getPercentage()
    {
        return $this->percentage;
    }
}
