<?php

namespace HGT\Application\Catalog\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Product\ProductCategoryRepository")
 * @ORM\Table(name="product_category")
 */
class ProductCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Product\Product", inversedBy="product_category")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Catalog\Category\Category", inversedBy="product_category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;
}
