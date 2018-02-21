<?php

namespace HGT\Application\User;

use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Repository\Catalog\Cart\CartRepository;
use HGT\AppBundle\Repository\User\Customer\CustomerRepository;
use HGT\AppBundle\Security\PasswordEncoder;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\CartService;
use HGT\Application\User\Customer\Customer;
//use HGT\Application\User\PasswordResetHash\Customer; --> Waarom geeft deze een conflict ?
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var CartService
     */
    private $cartService;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepository
     * @param PasswordEncoder $passwordEncoder
     * @param CartRepository $cartRepository
     * @param CartService $cartService
     * @param TokenStorageInterface $tokenStorage
     * @param EntityManager $entityManager
     */
    public function __construct(
        CustomerRepository $customerRepository,
        PasswordEncoder $passwordEncoder,
        CartRepository $cartRepository,
        CartService $cartService,
        TokenStorageInterface $tokenStorage,
        EntityManager $entityManager
    ) {
        $this->customerRepository = $customerRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->cartRepository = $cartRepository;
        $this->tokenStorage = $tokenStorage;
        $this->cartService = $cartService;
        $this->entityManager = $entityManager;
    }

    /**
     * @param $username string
     * @return \HGT\AppBundle\Repository\User\Customer\Customer|object
     */
    public function getCustomerByUsername($username)
    {
        return $this->customerRepository->getByUsername($username);
    }

    /**
     * @return Customer
     */
    public function getCurrentCustomer()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    /**
     * @param $customerId
     * @param $password
     *
     * @return Customer|object
     */
    public function updatePassword($customerId, $password)
    {
        $customer = $this->customerRepository->get($customerId);

        if ($customer) {
            $customer->setPassword($this->passwordEncoder->encodePassword($password));
            $customer->setOldPassword(null);
        }

        return $customer;
    }

    /**
     * @param bool $create_when_not_found
     * @return Cart
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getOpenCart($create_when_not_found = false)
    {
        /** @var Customer $customer */
        $customer = $this->tokenStorage->getToken()->getUser();
        $cart = $this->getOpenCartForCustomer($customer->getId());

        if (!$cart && $create_when_not_found) {
            $em = $this->entityManager;
            $cart = $this->_createCart();
            $cart = $this->cartRepository->add($cart);
            $em->flush();
        }

        return $cart;
    }

    /**
     * @param $customer_id
     * @return null|object
     */
    public function getOpenCartForCustomer($customer_id)
    {
        return $this->cartRepository->getOpenCartForCustomer($customer_id);
    }

    /**
     * @return Cart
     */
    private function _createCart()
    {
        $customer = $this->tokenStorage->getToken()->getUser();

        $cart = $this->cartService->createCart();
        $cart->setCustomer($customer);

        return $cart;
    }
}
