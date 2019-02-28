<?php
namespace Syclass\FipeBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Syclass\FipeBundle\Entity\FipeManufacturer;
use Syclass\FipeBundle\Entity\FipeManufacturerUpdate;
use Syclass\FipeBundle\Entity\FipeTable;

/**
 * FipeManufacturerRepository
 *
 */
class FipeManufacturerRepository extends EntityRepository {
    const LIMIT = 100;
    /**
     * Get manufacturer no updated in last week.
     * @return \Syclass\FipeBundle\Entity\FipeManufacturer[]
     **/
    public function findNoUpdated(){
        $time = new \DateTime();
        $time->sub(new \DateInterval('P7D'));
        // echo
        return $this->getEntityManager()
            ->createQuery('SELECT m, u, t2 FROM SyclassFipeBundle:FipeManufacturer m
                JOIN m.tables t
                JOIN m.updates u
                JOIN u.table t2
                WHERE u.updated < :time
                AND t.id = t2.id
            ')
            ->setMaxResults(self::LIMIT)
            ->setParameter('time', $time)
            // ->getSql();die;
            ->getResult();
    }

    public function getManufacturers() {
        return $this->getEntityManager()
                    ->createQuery('SELECT m FROM  SyclassFipeBundle:FipeManufacturer m
                                    ORDER BY m.manufacturer ASC')
                    ->getResult();
    }
    public function hasTable(FipeManufacturer $manufacturer, FipeTable $table) {
        return $this->getEntityManager()
                    ->createQuery('SELECT COUNT(m) FROM  SyclassFipeBundle:FipeManufacturer m
                        JOIN m.updates u
                        JOIN u.table t
                        WHERE m.id = :manufacturer
                        AND t.id = :table
                    ')
                    ->setParameters(Array(
                        'manufacturer' => $manufacturer->getId(),
                        'table' => $table->getId()
                    ))
                    ->getSingleScalarResult() > 0;
    }
    /**
     * List vehicles for manufacturer and table informed.
     **/
    public function getVehiclesByTable($manufacturer, $table) {
        return $this->getEntityManager()
                    ->createQuery('SELECT m,v,t FROM  SyclassFipeBundle:FipeManufacturer m
                        JOIN m.tables t
                        LEFT JOIN m.vehicles v
                        LEFT JOIN v.tables t2 WITH t2.id = t.id
                        WHERE m.slug = :manufacturer
                        AND t.slug = :table
                    ')
                    ->setParameters(Array(
                        'manufacturer' => $manufacturer,
                        'table' => $table
                    ))
                    ->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    public function saveManufacturer(FipeManufacturer $manufacturer){
        $manufacturer->setUpdated(new \DateTime());
        $em = $this->getEntityManager();
        $em->persist($manufacturer);
        $em->flush();
    }

    public function saveUpdate(FipeManufacturerUpdate $update){
        $update->setUpdated(new \DateTime());
        $em = $this->getEntityManager();
        $em->persist($update);
        $em->flush();
    }

    public function addTable(FipeManufacturer $manufacturer, FipeTable $table){
        $mt = new FipeManufacturerUpdate();
        $mt->setId($manufacturer->getId().'-'.$table->getId());
        $mt->setManufacturer($manufacturer);
        $mt->setTable($table);
        $mt->setInserted( new \DateTime());
        $mt->setUpdated(\DateTime::createFromFormat('U', 1));
        $em = $this->getEntityManager();
        $em->persist($mt);
        $em->flush();
    }
}
