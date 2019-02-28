<?php

namespace Syclass\FipeBundle\Monitor;
use Syclass\FipeBundle\Entity\FipeTable;
// use Syclass\FipeBundle\Entity\FipeVehicleYear;
use Syclass\FipeBundle\Entity\FipeVehiclePrice;
use Syclass\FipeBundle\Fipe;

class Price
{
    private $count = 0;
    /**
     * @var EntityManager
     *
     */
    private $em;

    /**
     * @var \Syclass\FipeBundle\Repository\FipeVehiclePrice
     */
    private $repository;
    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine, \Syclass\Kernel $kernel)
    {
        $this->em = $doctrine->getEntityManager();
        $this->repository = $this->em->getRepository(FipeVehiclePrice::class);
    }
    public function execute($vehicle = NULL, $table = NULL)
    {
        if(NULL !== $vehicle){
            foreach($vehicle->getTables() as $table){
                foreach($vehicle->getYears() as $year){
                    $this->updatePrice($vehicle, $year, $table);
                }
            }
            return;
        }

        // Get the vehicles list
        foreach($this->repository->findNoPriceVehicles() as $year){
            $vehicle = $year->getVehicle();
            foreach($year->getTables() as $table){
                $this->updatePrice($vehicle, $year, $table);
            }
        }
    }
    protected function updatePrice($vehicle, $year, $table)
    {
        // echo $vehicle->getName() . ' - ' . $year->getName() . ' - ' . $table->getDescription() . ': ';
        $price = Fipe::getFipePrice($vehicle, $year, $table->getId());
        if(isset($price->CodigoFipe) && '0' !== $price->CodigoFipe){
            $this->insertVehiclePrice($price, $vehicle, $table, $year);
        }else{
            $this->removeVehicleYearFromTable($year, $table);
            // echo "Codigo 0\r\n";
        }

    }
    private function removeVehicleYearFromTable($year, $table)
    {
        $table->removeYear($year);
        $this->em->getRepository(FipeTable::class)->saveTable($table);
    }
    private function insertVehiclePrice($price, $vehicle, $table, $year)
    {
        // echo $price->Valor . "\r\n";
        $oPrice = $this->repository->find($year->getId() . '-' . $table->getId());
        if(!$oPrice){
            $oPrice = new FipeVehiclePrice();
            $oPrice->setId($year->getId() . '-' . $table->getId());
            $oPrice->setSlug($table->getDescription());
            $oPrice->setVehicle($vehicle);
            $oPrice->setManufacturer($vehicle->getManufacturer());
            $oPrice->setYear($year);
            $oPrice->setPrice(preg_replace('/[^0-9]/', '', $price->Valor) / 100);
            $oPrice->setTable($table);
            $oPrice->setInserted(new \DateTime());
        }
        $oPrice->setUpdated(new \DateTime());
        $this->repository->savePrice($oPrice);
    }

}
