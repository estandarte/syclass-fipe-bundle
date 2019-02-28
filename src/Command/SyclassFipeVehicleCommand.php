<?php

namespace Syclass\FipeBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Syclass\FipeBundle\Monitor\Vehicle;

class SyclassFipeVehicleCommand extends Command
{
    protected $monitor;
    protected static $defaultName = 'syclass:fipe:vehicle';
    public function __construct(Vehicle $monitor)
    {
        parent::__construct();
        $this->monitor = $monitor;
    }
    protected function configure()
    {
        $this
            ->setDescription('Update FIPE Vehicles')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->monitor->execute();
        // $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
