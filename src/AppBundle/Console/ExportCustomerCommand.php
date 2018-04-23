<?php

namespace HGT\AppBundle\Console;

use HGT\Application\User\CustomerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExportCustomerCommand extends Command
{
    /**
     * @var CustomerService
     */
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('hgt:export-customer')
            ->setDescription('Exporteer een customer.')
            ->addArgument('customer_id', InputArgument::REQUIRED, 'Het ID van de customer.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $customer = $this->customerService->get((int)$input->getArgument('customer_id'));

        if ($customer !== null) {
            $this->customerService->exportToNavision($customer);

            $output->writeln([
                '',
                'Customer ' . $customer->getId() . ' is geexporteerd',
                '',
            ]);
        } else {
            $output->writeln([
                '',
                'Ongeldige ID!',
                '',
            ]);
        }
    }
}
