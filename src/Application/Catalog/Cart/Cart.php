<?php

namespace HGT\Application\Catalog\Cart;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use HGT\Application\User\Customer\Customer;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Catalog\Cart\CartRepository")
 * @ORM\Table(name="cart")
 */
class Cart
{
    const STATE_OPEN = 'open';
    const STATE_FINISHED = 'finished';
    const STATE_EXPORTING = 'exporting';
    const STATE_EXPORTED = 'exported';

    /**
     * @ORM\OneToMany(targetEntity="HGT\Application\Catalog\Cart\CartProduct", mappedBy="cart")
     */
    private $cartProducts;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\Customer\Customer")
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
     * Cart constructor.
     */
    public function __construct()
    {
        $this->cartProducts = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
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
    public function getFinishedDate()
    {
        return $this->finished_date;
    }

    /**
     * @param DateTime $finished_date
     */
    public function setFinishedDate($finished_date)
    {
        $this->finished_date = $finished_date;
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
     * @return string
     */
    public function getState()
    {
        return $this->state;
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
     * @return float
     */
    public function getTotalExTax()
    {
        return $this->total_ex_tax;
    }

    /**
     * @param float $total_ex_tax
     */
    public function setTotalExTax($total_ex_tax)
    {
        $this->total_ex_tax = $total_ex_tax;
    }

    /**
     * @param float $total_inc_tax
     */
    public function setTotalIncTax($total_inc_tax)
    {
        $this->total_inc_tax = $total_inc_tax;
    }

    /**
     * @param string $ip_address
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
    }

    /**
     * @return CartProduct[]|ArrayCollection
     */
    public function getCartProducts()
    {
        return $this->cartProducts;
    }
}
