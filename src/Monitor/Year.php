<?php

namespace Syclass\FipeBundle\Monitor;
use Syclass\FipeBundle\Entity\FipeTable;
use Syclass\FipeBundle\Entity\FipeManufacturer;
use Syclass\FipeBundle\Entity\FipeVehicle;
use Syclass\FipeBundle\Entity\FipeVehicleYear;
use Syclass\FipeBundle\Fipe;

class Year
{
    private $count = 0;
    /**
     * @var EntityManager
     *
     */
    private $em;

    /**
     * @var \Syclass\FipeBundle\Repository\FipeVehicleYear
     */
    private $repository;
    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine, \Syclass\Kernel $kernel)
    {
        $this->em = $doctrine->getEntityManager();
        $this->repository = $this->em->getRepository(FipeVehicleYear::class);
    }
    public function execute($vehicle = NULL, $table = NULL)
    {
        if(NULL === $vehicle){
            $this->updateAll();
        } else {
            $this->getFipeYears($vehicle, $table);
        }
    }
    protected function getFipeYears($vehicle, $table){
        foreach (Fipe::getFipeYears($vehicle, $table) as $year) {
            if(isset($year->Value) && '0' != $year->Value){
                $this->insertVehicleYear($year, $vehicle, $table);
            }
        }
    }
    public function updateAll(){
        $vehicleRepository = $this->em->getRepository(FipeVehicle::class);
        foreach($vehicleRepository->findNoUpdated() as $vehicle){
            $manufacturer = $vehicle->getManufacturer();
            foreach($vehicle->getUpdates() as $oUpdate){
                $table = $oUpdate->getTable();
                $this->getFipeYears($vehicle, $table);
                $vehicleRepository->saveUpdate($oUpdate);
            }
        }
    }
    private function insertVehicleYear($year, $vehicle, $table) {
        $name = $year->Value;
        echo (++$this->count) . ' - ' . $vehicle->getName() . '-' . $name . ' - ' . $table->getDescription() . "\r\n";
        $oYear = $this->repository->find($vehicle->getId() . '-' . $name);
        if (!$oYear) {
            $oYear = new FipeVehicleYear();
            $oYear->setId($vehicle->getId() . '-' . $year->Value);
            $oYear->setName($year->Label);
            $oYear->setSlug($year->Value);
            $oYear->setManufacturer($vehicle->getManufacturer());
            $oYear->setVehicle($vehicle);
            $oYear->setInserted(new \DateTime());
            $this->repository->saveYear($oYear);
        }
        // Join year to table
        $tables = $oYear->getTables();
        if (!is_object($tables) || !$tables->contains($table)) {
            $table->addYear($oYear);
            $this->em->getRepository(FipeTable::class)->saveTable($table);
        }

    }

}
