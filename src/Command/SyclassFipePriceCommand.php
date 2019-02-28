<?php

namespace Syclass\FipeBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Syclass\FipeBundle\Monitor\Price;

class SyclassFipePriceCommand extends Command
{
    protected $monitor;
    protected static $defaultName = 'syclass:fipe:price';
    public function __construct(Price $monitor)
    {
        parent::__construct();
        $this->monitor = $monitor;
    }
    protected function configure()
    {
        $this
            ->setDescription('Update FIPE Vehicles Prices')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->monitor->execute();
        $io->success('Prices Updated.');
    }
}
