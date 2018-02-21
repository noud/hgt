<?php

namespace HGT\Application\Catalog\Cart;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Cart\CartRepository")
 * @ORM\Table(name="cart")
 */
class Cart
{
    protected $cartProducts;

    public function __construct()
    {
        $this->cartProducts = new ArrayCollection();
    }

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
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\Customer\Customer", inversedBy="cart")
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param DateTime $created_date
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
    }

    /**
     * @return DateTime
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
    }

    /**
     * @param DateTime $delivery_date
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->delivery_date = $delivery_date;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @param string $ip_address
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
    }

    /**
     * @return ArrayCollection|CartProduct[]
     */
    public function getCartProducts()
    {
        return $this->cartProducts;
    }
}
