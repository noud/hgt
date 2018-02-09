<?php

namespace AppBundle\Entity;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WebOrderRepository")
 * @ORM\Table(name="web_order")
 */
class WebOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cart", inversedBy="web_order")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $cart;

    /**
     * @var DateTime;
     * @ORM\Column(type="datetime", nullable=true, options={"default":NULL})
     */
    private $export_date;
}
