<?php

namespace AppBundle\Entity;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InvalidDeliveryDateRepository")
 * @ORM\Table(name="invalid_delivery_date")
 */
class InvalidDeliveryDate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var DateTime
     * @ORM\Column(type="date")
     */
    private $invalid_delivery_date;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $note;
}
