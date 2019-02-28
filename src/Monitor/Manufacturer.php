<?php

namespace Syclass\FipeBundle\Monitor;
use Syclass\FipeBundle\Entity\FipeTable;
use Syclass\FipeBundle\Entity\FipeManufacturer;
use Syclass\FipeBundle\Fipe;

class Manufacturer{
    private $count = 0;
    /**
     * @var EntityManager
     *
     */
    private $em;

    /**
     * @var \Syclass\FipeBundle\Repository\FipeManufacturer
     */
    private $repository;
    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine, \Syclass\Kernel $kernel){
        $this->em = $doctrine->getEntityManager();
        $this->repository = $this->em->getRepository(FipeManufacturer::class);
    }
    public function execute(){
        $tableRepository = $this->em->getRepository(FipeTable::class);
        foreach($tableRepository->findNoUpdated() as $table){
            echo (++$this->count) . ' - ' . $table->getDescription() . "\r\n";
            foreach (Fipe::getFipeManufacturer($table) as $manufacturer) {
                if(isset($manufacturer->Value) && '0' != $manufacturer->Value){
                    $this->insertManufacturer($manufacturer, $table);
                }
            }
            $table->setChecked(new \DateTime());
            $tableRepository->saveTable($table);
        }
    }
    private function insertManufacturer($manufacturer, $table){
        $oManufacturer = $this->repository->find($manufacturer->Value);
        if (!$oManufacturer) {
            //save new manufacturer
            $oManufacturer = new FipeManufacturer();
            $oManufacturer->setId($manufacturer->Value);
            $oManufacturer->setManufacturer($manufacturer->Label);
            $oManufacturer->setName($manufacturer->Label);
            $oManufacturer->setSlug($manufacturer->Label);
            $oManufacturer->setInserted(new \DateTime());
            $this->repository->saveManufacturer($oManufacturer);
        }
        // Join manufacturer to table
        if (is_null($oManufacturer->getTables()) || !$oManufacturer->getTables()->contains($table)) {
            $table->addManufacturer($oManufacturer);
            $this->em->getRepository(FipeTable::class)->saveTable($table);
        }

        // Join manufacturer to table
        if (!$this->repository->hasTable($oManufacturer, $table)) {
            $this->repository->addTable($oManufacturer, $table);
        }
    }

}
