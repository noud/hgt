<?php

namespace HGT\Application\User\CustomerTaxGroup;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\CustomerTaxGroup\CustomerTaxGroupRepository")
 * @ORM\Table(name="customer_tax_group")
 */
class CustomerTaxGroup
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
