<?php

namespace HGT\Application\User\Customer;

use Doctrine\ORM\Mapping as ORM;
use HGT\Application\Content\SelectionCode\SelectionCode;
use HGT\Application\User\CustomerGroup\CustomerGroup;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\User\Customer\CustomerRepository")
 * @ORM\Table(name="customer")
 */
class Customer implements UserInterface
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $old_password;

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
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerPriceGroup\CustomerPriceGroup")
     */
    private $customer_price_group;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerGroup\CustomerGroup", inversedBy="customers")
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
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerTaxGroup\CustomerTaxGroup")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_tax_group;

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
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\CustomerDiscountGroup\CustomerDiscountGroup")
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
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\SelectionCode\SelectionCode")
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

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [
            'ROLE_CUSTOMER'
        ];
    }

    /**
     * @param string|null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string|null $old_password
     */
    public function setOldPassword($old_password)
    {
        $this->old_password = $old_password;
    }

    /**
     * @return string
     */
    public function getOldPassword()
    {
        return $this->old_password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return '';
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        //
    }

    /**
     * @return bool
     */
    public function canSeePrices()
    {
        return $this->show_prices;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return implode(' ', [
            $this->first_name,
            $this->last_name,
        ]);
    }

    /**
     * @return bool
     */
    public function isBlocked()
    {
        return $this->blocked;
    }

    /**
     * @return SelectionCode
     */
    public function getSelectionCode()
    {
        return $this->selection_code;
    }

    /**
     * @return CustomerGroup
     */
    public function getCustomerGroup()
    {
        return $this->customer_group;
    }

    /**
     * @return string
     */
    public function getDeliveryDays()
    {
        return $this->delivery_days;
    }

    /**
     * @return mixed
     */
    public function getCustomerTaxGroup()
    {
        return $this->customer_tax_group;
    }

    /**
     * @return mixed
     */
    public function getCustomerPriceGroup()
    {
        return $this->customer_price_group;
    }

    /**
     * @return string
     */
    public function getNavisionPricingDiscountId()
    {
        return $this->navision_pricing_discount_id;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getNavisionId()
    {
        return $this->navision_id;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getShippingCompany()
    {
        return $this->shipping_company;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->post_code;
    }

    /**
     * @return bool
     */
    public function isShowPrices()
    {
        return $this->show_prices;
    }

    /**
     * @return string
     */
    public function getPasswordToken()
    {
        return $this->password_token;
    }

    /**
     * @return string
     */
    public function getShippingFirstName()
    {
        return $this->shipping_first_name;
    }

    /**
     * @return string
     */
    public function getShippingLastName()
    {
        return $this->shipping_last_name;
    }

    /**
     * @return string
     */
    public function getShippingAddress1()
    {
        return $this->shipping_address1;
    }

    /**
     * @return string
     */
    public function getShippingAddress2()
    {
        return $this->shipping_address2;
    }

    /**
     * @return string
     */
    public function getShippingCity()
    {
        return $this->shipping_city;
    }

    /**
     * @return string
     */
    public function getShippingPostCode()
    {
        return $this->shipping_post_code;
    }

    /**
     * @return string
     */
    public function getShippingCountry()
    {
        return $this->shipping_country;
    }

    /**
     * @return string
     */
    public function getShippingPhone()
    {
        return $this->shipping_phone;
    }

    /**
     * @return string
     */
    public function getShippingFax()
    {
        return $this->shipping_fax;
    }

    /**
     * @return string
     */
    public function getShippingEmail()
    {
        return $this->shipping_email;
    }

    /**
     * @return string
     */
    public function getChamberOfCommerceNumber()
    {
        return $this->chamber_of_commerce_number;
    }

    /**
     * @return string
     */
    public function getMerchantNotes()
    {
        return $this->merchant_notes;
    }

    /**
     * @return string
     */
    public function getPaymentTerms()
    {
        return $this->payment_terms;
    }

    /**
     * @return mixed
     */
    public function getCustomerDiscountGroup()
    {
        return $this->customer_discount_group;
    }

    /**
     * @return string
     */
    public function getCustomerVatNumber()
    {
        return $this->customer_vat_number;
    }

    /**
     * @return bool
     */
    public function isBuyingOnAccount()
    {
        return $this->is_buying_on_account;
    }

    /**
     * @return bool
     */
    public function isAllowLineDiscount()
    {
        return $this->allow_line_discount;
    }
}
