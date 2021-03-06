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
     * @var int
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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNavisionId()
    {
        return $this->navision_id;
    }

    /**
     * @param string
     */
    public function setNavisionId($navision_id)
    {
        $this->navision_id = $navision_id;
    }
}
