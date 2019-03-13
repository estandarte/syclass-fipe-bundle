<?php

namespace Syclass\FipeBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Syclass\FipeBundle\Monitor\Table;
use Syclass\FipeBundle\Monitor\Manufacturer;
use Syclass\FipeBundle\Monitor\Vehicle;
use Syclass\FipeBundle\Monitor\Year;
use Syclass\FipeBundle\Monitor\Price;

class SyclassFipeAllCommand extends Command
{
    protected $monitor;
    protected static $defaultName = 'syclass:fipe:all';
    public function __construct(Table $table, Manufacturer $manufacturer, Vehicle $vehicle, Year $year, Price $price)
    {
        parent::__construct();
        $this->table = $table;
        $this->manufacturer = $manufacturer;
        $this->vehicle = $vehicle;
        $this->year = $year;
        $this->price = $price;
    }
    protected function configure()
    {
        $this
            ->setDescription('Update All FIPE Data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $this->table->execute();
        $this->manufacturer->execute();
        $this->vehicle->execute();
        $this->year->execute();
        $this->price->execute();

        $io->success('All Data Updated.');
    }
}
