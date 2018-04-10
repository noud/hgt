<?php

namespace HGT\AppBundle\Console;

use HGT\Application\Catalog\Order\WebOrder;
use HGT\Application\Catalog\WebOrderService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExportWebOrderCommand extends Command
{
    /**
     * @var WebOrderService
     */
    private $webOrderService;

    public function __construct(WebOrderService $webOrderService)
    {
        $this->webOrderService = $webOrderService;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('hgt:export-order')
            ->setDescription('Exporteer een order.')
            ->addArgument('order_id', InputArgument::REQUIRED, 'Het ID van de order.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $webOrders = $this->webOrderService->getAll();

        if ($webOrders) {
            $webOrdersNumbers = [];

            foreach ($webOrders as $webOrder) {
                $webOrdersNumbers[] = $webOrder->getId();
            }

            if (in_array($input->getArgument('order_id'), $webOrdersNumbers)) {

                /** @var WebOrder $webOrder */
                $webOrder = $this->webOrderService->get($input->getArgument('order_id'));

                $this->webOrderService->exportToNavision($webOrder);

                $output->writeln([
                    '',
                    'Order ' . $webOrder->getId() . ' is geexporteerd',
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
}
