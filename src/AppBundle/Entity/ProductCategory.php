<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductCategoryRepository")
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


    //@TODO: product_id > product.id
    //@TODO: category_id > category.id
}
