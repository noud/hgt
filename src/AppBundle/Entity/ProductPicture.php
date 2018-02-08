<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductPictureRepository")
 * @ORM\Table(name="product_picture")
 */
class ProductPicture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="product_picture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $navision_id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $filename;
}
