<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CartRepository")
 * @ORM\Table(name="cart")
 */
class Cart
{
    const STATE_OPEN = 'open';
    const STATE_FINISHED = 'finished';
    const STATE_EXPORTING = 'exporting';
    const STATE_EXPORTED = 'exported';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer", inversedBy="cart")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $customer;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @var DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    private $finished_date;

    /**
     * @var DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    private $delivery_date;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $reference;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     */
    private $note;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2, nullable=true)
     */
    private $total_ex_tax;

    /**
     * @var float
     * @ORM\Column(type="float", precision=2, nullable=true)
     */
    private $total_inc_tax;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $ip_address;
}
