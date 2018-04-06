<?php

namespace HGT\AppBundle\Controller\Customer;

use Doctrine\ORM\EntityManagerInterface;
use HGT\AppBundle\Form\Customer\Account\OrderListEditForm;
use HGT\AppBundle\Form\Customer\Account\OrderListForm;
use HGT\AppBundle\Mailer\Sender\CustomerProductRemovalSender;
use HGT\AppBundle\Security\PasswordEncoder;
use HGT\Application\Account\Command\ReviseOrderListEditProduct;
use HGT\Application\Account\Command\ReviseOrderListProduct;
use HGT\Application\Catalog\Cart\Command\DefineCartProductCommand;
use HGT\Application\Catalog\CartProductService;
use HGT\Application\Catalog\CartService;
use HGT\Application\User\Command\ChangePasswordCommand;
use HGT\Application\User\CustomerOrder\CustomerOrder;
use HGT\Application\User\CustomerOrderLineService;
use HGT\Application\User\CustomerOrderService;
use HGT\Application\User\CustomerProductService;
use HGT\Application\User\CustomerService;
use HGT\Application\User\Form\ChangePasswordFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * AccountController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        PasswordEncoder $passwordEncoder
    )
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/mijn-account", name="account_index")
     * @param Request $request
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('account/account.html.twig');
    }

    /**
     * @Route("/mijn-account/bestellijst", name="account_order_list")
     * @param Request $request
     * @param CustomerService $customerService
     * @param CustomerProductService $customerProductService
     * @param CartService $cartService
     * @param CartProductService $cartProductService
     * @return Response
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
        $customerProducts = $customerProductService->getCustomerProducts($customerService->getCurrentCustomer()
            ->getCustomerGroup());

        $command = new ReviseOrderListProduct($customerProducts);
        $form = $this->createForm(OrderListForm::class, $command);

        $cart = $cartService->getOpenCart();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($command->products as $increaseOrderListProduct) {
                $defineCartProductCommand = new DefineCartProductCommand($increaseOrderListProduct->product
                    ->getProduct(), $cart);
                $defineCartProductCommand->unit_of_measure = $increaseOrderListProduct->product->getUnitOfMeasure();
                $defineCartProductCommand->qty = $increaseOrderListProduct->increase;
                $cartProductService->defineCartProduct($defineCartProductCommand);
            }
            $this->entityManager->flush();
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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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

        $customerProducts = $customerProductService->getCustomerProducts($customerService->getCurrentCustomer()
            ->getCustomerGroup());
        $command = new ReviseOrderListEditProduct($customerProducts);
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
     * @Route("/mijn-account/bestellijst-aanpassen/drag", name="account_order_list_edit_drag")
     * @param Request $request
     * @param CustomerProductService $customerProductService
     * @param CustomerService $customerService
     * @return JsonResponse
     */
    public function orderListEditDragAction(
        Request $request,
        CustomerProductService $customerProductService,
        CustomerService $customerService
    ) {

        $inOrderProducts = array_map('intval', explode(',', $request->get('data')));
        $customer = $customerService->getCurrentCustomer();

        $customerProductService->reOrderCustomerProducts($inOrderProducts, $customer);

        $this->entityManager->flush();

        return new JsonResponse($inOrderProducts);
    }

    /**
     * @Route("/mijn-account/bestelhistorie", name="account_order_history")
     * @param CustomerOrderService $customerOrderService
     * @param CustomerService $customerService
     * @return Response
     */
    public function orderHistoryAction(
        CustomerOrderService $customerOrderService,
        CustomerService $customerService
    ) {
        $deliveredCustomerOrders = $customerOrderService->getCustomerOrders(
            $customerService->getCurrentCustomer(),
            true
        );
        $customerOrders = $customerOrderService->getCustomerOrders($customerService->getCurrentCustomer());

        return $this->render('account/order-history.html.twig', [
            'deliveredCustomerOrders' => $deliveredCustomerOrders,
            'customerOrders' => $customerOrders,
        ]);
    }

    /**
     * @Route("/mijn-account/bestelhistorie/view/{id}", name="account_order_history_view")
     * @param CustomerOrderService $customerOrderService
     * @param CustomerOrder $customerOrder
     * @param CustomerOrderLineService $customerOrderLineService
     * @param CustomerService $customerService
     * @return Response
     */
    public function orderHistoryViewAction(
        CustomerOrderService $customerOrderService,
        CustomerOrder $customerOrder,
        CustomerOrderLineService $customerOrderLineService,
        CustomerService $customerService
    ) {
        $customerOrder = $customerOrderService->get($customerOrder);
        $customerOrderLines = $customerOrderLineService->getByCustomerOrder($customerOrder);
        $customer = $customerService->getCurrentCustomer();

        return $this->render('account/order.html.twig', [
            'customer' => $customer,
            'customerOrder' => $customerOrder,
            'customerOrderLines' => $customerOrderLines,
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

    /**
     * @Route("/mijn-account/password", name="account_password")
     */
    public function passwordChangeAction(
        Request $request,
        CustomerService $customerService
    )
    {
        $customer = $customerService->getCurrentCustomer();
        $command = new ChangePasswordCommand();
        $form = $this->createForm(ChangePasswordFormType::class, $command);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->passwordEncoder->isPasswordValid($customer, $command->getOldPassword())) {
                $this->addFlash('danger', 'Incorrect current password');
                return $this->redirectToRoute('account_index');
            }

            $customerService->updatePassword($customer->getId(), $command->getPlainPassword());
            $this->entityManager->flush();

            $this->addFlash('success', 'Password changed');
            return $this->redirectToRoute('account_password');
        } else {
            dump("NOT VALID");
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
