<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
 * @ORM\Table(name="customer")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $navision_id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, options={"default":NULL})
     */
    private $username;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $blocked;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $first_name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $last_name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $company;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $show_prices;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CustomerPriceGroup", inversedBy="customer")
     */
    private $customer_price_group;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CustomerGroup", inversedBy="customer")
     */
    private $customer_group;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, options={"default":NULL})
     */
    private $password_token;

    /**
     * @var string
     * @ORM\Column(type="string", options={"comment":"0 (for Sunday) through 6 (for Saturday)"})
     */
    private $delivery_days;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CustomerTaxGroup", inversedBy="customer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_tax_grup;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $address1;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $address2;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $fax;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $post_code;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_first_name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_last_name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_company;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_address1;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_address2;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_city;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_post_code;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_country;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_phone;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_fax;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $shipping_email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $chamber_of_commerce_number;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     */
    private $merchant_notes;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $payment_terms;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CustomerDiscountGroup", inversedBy="customer")
     */
    private $customer_discount_group;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $navision_pricing_discount_id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $customer_vat_number;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SelectionCode", inversedBy="customer")
     */
    private $selection_code;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $is_buying_on_account;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $allow_line_discount;
}
