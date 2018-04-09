<?php

namespace HGT\Application\User\CustomerPriceGroup;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\CustomerPriceGroup\CustomerPriceGroupRepository")
 * @ORM\Table(name="customer_price_group")
 */
class CustomerPriceGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $navision_id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNavisionId()
    {
        return $this->navision_id;
    }

    /**
     * @param string $navision_id
     */
    public function setNavisionId($navision_id)
    {
        $this->navision_id = $navision_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
