<?php

namespace HGT\Application\Catalog\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Category\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Category\Category", inversedBy="category")
     * @ORM\JoinColumn(name="parent_id", onDelete="CASCADE", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $navision_id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     */
    private $short_description;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $picture;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $show_homepage;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $priority;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $url_key;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $product_count;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $total_product_count;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $level;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
}
