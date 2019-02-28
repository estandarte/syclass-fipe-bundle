<?php
namespace Syclass\FipeBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Syclass\FipeBundle\Entity\FipeVehicle;
use Syclass\FipeBundle\Entity\FipeVehicleUpdate;
use Syclass\FipeBundle\Entity\FipeTable;

/**
 * FipeVehicleRepository
 *
 */
class FipeVehicleRepository extends EntityRepository {
    const LIMIT = 2000;

    /**
     * Get vehicles no updated in last week.
     * @return \Syclass\FipeBundle\Entity\FipeVehicle[]
     **/
    public function findNoUpdated(){
        $time = new \DateTime();
        $time->sub(new \DateInterval('P7D'));
        return $this->getEntityManager()
            ->createQuery('SELECT v, t, u FROM SyclassFipeBundle:FipeVehicle v
                JOIN v.tables t
                JOIN v.updates u
                JOIN u.table t2
                WHERE t.id = t2.id
                AND u.updated < :time
            ')
            ->setMaxResults(self::LIMIT)
            ->setParameter('time', $time)
            ->getResult()
        ;
    }

    public function getVehicles() {
        return $this->getEntityManager()
                    ->createQuery('SELECT v FROM  SyclassFipeBundle:FipeVehicle v
                                    ORDER BY v.name ASC')
                    ->getResult();
    }
    public function findByTableManufacturer($table, $manufacturer) {
        return $this->getEntityManager()
                    ->createQuery('SELECT v FROM  SyclassFipeBundle:FipeVehicle v
                        JOIN v.tables t
                        WHERE v.manufacturer = :manufacturer
                        ORDER BY v.name ASC')
                    //     AND tx = :table
                    // ->setParameter('table', $table)
                    ->setParameter('manufacturer', $manufacturer)
                    ->getResult()
        ;
    }
    public function saveVehicle(FipeVehicle $vehicle, $checkUpdated = true){
        if($checkUpdated){
            $vehicle->setUpdated( new \DateTime());
        }
        $vehicle->setSearch($vehicle->getManufacturer()->getName() . ' ' . $vehicle->getName());
        $em = $this->getEntityManager();
        $em->persist($vehicle);
        $em->flush();
    }
    public function hasTable(FipeVehicle $vehicle, FipeTable $table) {
        return $this->getEntityManager()
                    ->createQuery('SELECT COUNT(v) FROM  SyclassFipeBundle:FipeVehicle v
                        JOIN v.updates u
                        JOIN u.table t
                        WHERE v.id = :vehicle
                        AND t.id = :table
                    ')
                    ->setParameters(Array(
                        'vehicle' => $vehicle->getId(),
                        'table' => $table->getId()
                    ))
                    ->getSingleScalarResult() > 0;
    }
    public function saveUpdate(FipeVehicleUpdate $update){
        $update->setUpdated(new \DateTime());
        $em = $this->getEntityManager();
        $em->persist($update);
        $em->flush();
    }

    public function addTable(FipeVehicle $vehicle, FipeTable $table){
        $mt = new FipeVehicleUpdate();
        $mt->setId($vehicle->getId().'-'.$table->getId());
        $mt->setVehicle($vehicle);
        $mt->setTable($table);
        $mt->setInserted( new \DateTime());
        $mt->setUpdated(\DateTime::createFromFormat('U', 0));
        $em = $this->getEntityManager();
        $em->persist($mt);
        $em->flush();
    }
}
