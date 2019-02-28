<?php

namespace Syclass\FipeBundle\Monitor;
use Syclass\FipeBundle\Entity\FipeVehicle;
use Syclass\FipeBundle\Entity\FipeManufacturer;
use Syclass\FipeBundle\Entity\FipeTable;
use Syclass\FipeBundle\Fipe;

class Vehicle
{
    private $count = 0;
    /**
     * @var EntityManager
     *
     */
    private $em;

    /**
     * @var \Syclass\FipeBundle\Repository\FipeVehicle
     */
    private $repository;
    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine, \Syclass\Kernel $kernel)
    {
        $this->em = $doctrine->getEntityManager();
        $this->repository = $this->em->getRepository(FipeVehicle::class);
    }
    public function execute($manufacturer = NULL, $table = NULL)
    {
        if(NULL === $manufacturer){
            $this->updateAll();
        } else {
            $this->getFipeVehicles($manufacturer, $table);
        }
    }
    public function updateAll(){
        $manufacturerRepository = $this->em->getRepository(FipeManufacturer::class);
        foreach($manufacturerRepository->findNoUpdated() as $manufacturer){
            foreach ($manufacturer->getUpdates() as $update) {
                $table = $update->getTable();
                echo (++$this->count) . ' - ' . $manufacturer->getManufacturer() . ' - ' . $table->getDescription(). "\r\n";
                $this->getFipeVehicles($manufacturer, $table);
                $manufacturerRepository->saveUpdate($update);
            }
        }
    }
    private function getFipeVehicles($manufacturer, $table){
        foreach (Fipe::getFipeVehicle($manufacturer, $table) as $vehicle) {
            if(isset($vehicle->Value) && '0' != $vehicle->Value){
                $this->insertVehicle($vehicle, $manufacturer, $table);
            }
        }
    }
    private function insertVehicle($vehicle, $manufacturer, $table){
        $oVehicle = $this->repository->find($manufacturer->getId() . '-' .$vehicle->Value);
        if(!$oVehicle && isset($vehicle->Value)){
            $oVehicle = new FipeVehicle();
            $oVehicle->setId($manufacturer->getId() . '-' .$vehicle->Value);
            $oVehicle->setName($vehicle->Label);
             $oVehicle->setSlug($vehicle->Label);
             $oVehicle->setVehicleId($vehicle->Value);
             $oVehicle->setManufacturer($manufacturer);
             $oVehicle->setInserted(new \DateTime());
             $oVehicle->setUpdated(\DateTime::createFromFormat('U', 0));
             $this->repository->saveVehicle($oVehicle);
        }
        // Join vehicle to table
        if(is_object($oVehicle)){
            $tables = $oVehicle->getTables();
            if (!is_object($tables) || !$tables->contains($table)) {
                $table->addVehicle($oVehicle);
                $this->em->getRepository(FipeTable::class)->saveTable($table);
            }

            // Join vehicle to table
            if (!$this->repository->hasTable($oVehicle, $table)) {
                $this->repository->addTable($oVehicle, $table);
            }
        }
    }
}
