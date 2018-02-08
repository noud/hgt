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


    //@TODO; product_tax_group_id > product_tax_group.id
    //@TODO; customer_tax_group_id > customer_tax_group.id


    /**
     * @var float
     * @ORM\Column(type="float", precision=2)
     */
    private $percentage;
}
