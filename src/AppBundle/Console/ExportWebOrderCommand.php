<?php

namespace HGT\AppBundle\Console;

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

    /**
     * ExportWebOrderCommand constructor.
     * @param WebOrderService $webOrderService
     */
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

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $webOrder = $this->webOrderService->get((int)$input->getArgument('order_id'));

        if ($webOrder !== null) {
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
