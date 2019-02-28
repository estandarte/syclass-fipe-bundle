<?php

namespace Syclass\FipeBundle\Monitor;
use Syclass\FipeBundle\Entity\FipeTable;
use Syclass\FipeBundle\Fipe;

class Table{
    /**
     * @var EntityManager
     *
     */
    private $em;
    /**
     * @var \Syclass\FipeBundle\Repository\FipeVehiclePrice
     */
    private $repository;
    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine, \Syclass\Kernel $kernel){
        $this->em = $doctrine->getEntityManager();
        $this->repository = $this->em->getRepository(FipeTable::class);
    }
    public function execute(){
        // Get the tables list
        foreach(Fipe::getFipeTables() as $table){
            $this->insertTable($table);
            $now = new \DateTime();
        }
    }
    private function insertTable($table){
        $oTable = $this->repository->find($table->Codigo);
        $description = explode('/', $table->Mes);
        $month = '01/' . trim($this->month($description[0]) .'/'. $description[1]);
        $month = \DateTime::createFromFormat('d/m/Y H:i:s', $month . ' 00:00:00');
        if(!$oTable){
            $oTable = new FipeTable();
            $oTable->setId($table->Codigo);
            $oTable->setDescription(trim($table->Mes));
            $oTable->setInserted(new \DateTime());
            // $oTable->setChecked(\DateTime::createFromFormat('d/m/Y', '01/01/2000'));
            $oTable->setMonth($month);
            $oTable->setSlug(trim($table->Mes));
            $this->repository->saveTable($oTable);
        }
    }
    private function month($index){
        $x = Array(
            'janeiro' => '01',
            'fevereiro' => '02',
            'março' => '03',
            'abril' => '04',
            'maio' => '05',
            'junho' => '06',
            'julho' => '07',
            'agosto' => '08',
            'setembro' => '09',
            'outubro' => '10',
            'novembro' => '11',
            'dezembro' => '12'
        );
        return $x[$index];
    }

}
