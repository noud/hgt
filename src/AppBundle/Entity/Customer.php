<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
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


    //@TODO: customer_price_group_id > customer_price_group.id
    //@TODO: customer_group_id > customer_group.id


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


    //@TODO: customer_tax_group_id > customer_tax_group.id


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


    //@TODO: customer_discount_group_id > customer_discount_group.id


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


    //@TODO: selection_code_id > selection_code.id


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
    public function getName()
    {
        return implode(' ', [
           $this->first_name,
           $this->last_name,
        ]);
    }
}
