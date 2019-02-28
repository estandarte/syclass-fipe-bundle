<?php
namespace Syclass\FipeBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Syclass\FipeBundle\Entity\FipeVehicleYear;

/**
 * FipeVehicleRepository
 *
 */
class FipeVehicleYearRepository extends EntityRepository {
    public function getYears() {
        return $this->getEntityManager()
                    ->createQuery('SELECT v FROM  SyclassFipeBundle:FipeVehicleYear v
                                    ORDER BY v.name ASC')
                    ->getResult();
    }
    public function saveYear(FipeVehicleYear $year){
        $year->setUpdated(new \DateTime());
        $em = $this->getEntityManager();
        $em->persist($year);
        $em->flush();
    }
}
