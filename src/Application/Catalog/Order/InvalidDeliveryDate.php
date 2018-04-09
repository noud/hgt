<?php

namespace HGT\Application\Catalog\Order;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Order\InvalidDeliveryDateRepository")
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

    /**
     * @return DateTime
     */
    public function getInvalidDeliveryDate()
    {
        return $this->invalid_delivery_date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

}
