<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxRepository")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductTaxGroup", inversedBy="tax")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_tax_group;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CustomerTaxGroup", inversedBy="tax")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_tax_group;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $percentage;
}
