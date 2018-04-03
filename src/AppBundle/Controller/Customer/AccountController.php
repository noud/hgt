<?php

namespace HGT\AppBundle\Controller\Customer;

use HGT\AppBundle\Form\Customer\Account\OrderListEditForm;
use HGT\AppBundle\Form\Customer\Account\OrderListForm;
use HGT\AppBundle\Mailer\Sender\CustomerProductRemovalSender;
use HGT\Application\Account\Command\ReviseOrderListEditProducts;
use HGT\Application\Account\Command\ReviseOrderListProduct;
use HGT\Application\Catalog\Cart\Command\DefineCartProductCommand;
use HGT\Application\Catalog\CartProductService;
use HGT\Application\Catalog\CartService;
use HGT\Application\User\CustomerProduct\CustomerProduct;
use HGT\Application\User\CustomerProductService;
use HGT\Application\User\CustomerService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    /**
     * @Route("/mijn-account", name="account_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('account/account.html.twig', [
        ]);
    }

    /**
     * @Route("/mijn-account/bestellijst", name="account_order_list")
     * @param Request $request
     * @param CustomerService $customerService
     * @param CustomerProductService $customerProductService
     * @param CartService $cartService
     * @param CartProductService $cartProductService
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function orderListAction(
        Request $request,
        CustomerService $customerService,
        CustomerProductService $customerProductService,
        CartService $cartService,
        CartProductService $cartProductService
    ) {
        if (is_null($customerService->getCurrentCustomer()->getCustomerGroup())) {
            return $this->render('account/order-list.html.twig');
        }

        $em = $this->getDoctrine()->getManager();
        $customerProducts = $customerProductService->getCustomerProducts($customerService->getCurrentCustomer()->getCustomerGroup());

        $command = new ReviseOrderListProduct($customerProducts);
        $form = $this->createForm(OrderListForm::class, $command);

        $cart = $cartService->getOpenCart();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CustomerProduct $customerProduct */
            foreach($customerProducts as $customerProduct) {

                $defineCartProductCommand = new DefineCartProductCommand($customerProduct->getProduct(), $cart);
                $defineCartProductCommand->unit_of_measure = $customerProduct->getUnitOfMeasure();

                dump($defineCartProductCommand);



                $cartProductService->defineCartProduct($defineCartProductCommand);

            }

            exit;


            $em->flush();
        }

        return $this->render('account/order-list.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mijn-account/bestellijst-aanpassen", name="account_order_list_edit")
     * @param Request $request
     * @param CustomerProductService $customerProductService
     * @param CustomerService $customerService
     * @param CustomerProductRemovalSender $customerProductRemovalSender
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function orderListEditAction(
        Request $request,
        CustomerProductService $customerProductService,
        CustomerService $customerService,
        CustomerProductRemovalSender $customerProductRemovalSender
    ) {
        if (is_null($customerService->getCurrentCustomer()->getCustomerGroup())) {
            return $this->render('account/order-list-edit.html.twig');
        }

        $customerProducts = $customerProductService->getCustomerProducts($customerService->getCurrentCustomer()->getCustomerGroup());

        $command = new ReviseOrderListEditProducts($customerProducts);
        $form = $this->createForm(OrderListEditForm::class, $command);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $customerProductData = $customerProductService->getSelectedCustomerProducts($command);

            if ($customerProductData['sendEmail']) {

                $customerProductRemovalSender->sendCustomerProductRemoval(
                    $customerService->getCurrentCustomer(),
                    $customerProductData['customerProducts']
                );

                $this->addFlash(
                    'success',
                    'Een email is verzonden. Binnen 2 dagen hoort.'
                );

            } else {
                $this->addFlash(
                    'danger',
                    'U dient tenminste een product aan te vinken om te verwijderen.'
                );
            }

            return $this->redirectToRoute('account_order_list_edit');
        }

        return $this->render('account/order-list-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mijn-account/bestelhistorie", name="account_order_history")
     */
    public function orderHistoryAction(Request $request)
    {
        return $this->render('account/order-history.html.twig', [
        ]);
    }

    /**
     * @throws \Exception
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached');
    }
}
