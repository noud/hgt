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
    public function getNavisionBrand()
    {
        return $this->navision_brand;
    }

    /**
     * @param string $navision_brand
     */
    public function setNavisionBrand($navision_brand)
    {
        $this->navision_brand = $navision_brand;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrlKey()
    {
        return $this->url_key;
    }

    /**
     * @param string $url_key
     */
    public function setUrlKey($url_key)
    {
        $this->url_key = $url_key;
    }

    /**
     * @return int
     */
    public function getTotalProductCount()
    {
        return $this->total_product_count;
    }

    /**
     * @param int $total_product_count
     */
    public function setTotalProductCount($total_product_count)
    {
        $this->total_product_count = $total_product_count;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
}
