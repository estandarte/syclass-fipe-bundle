<?php
namespace Syclass\FipeBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Syclass\FipeBundle\Entity\FipeVehiclePrice;
use Syclass\FipeBundle\Entity\FipeVehicle;

/**
 * FipeVehicleRepository
 *
 */
class FipeVehiclePriceRepository extends EntityRepository {
    const LIMIT = 5000;
    /**
     * List all prices.
     **/
    public function getPrices() {
        return $this->getEntityManager()
                    ->createQuery('SELECT v FROM  SyclassFipeBundle:FipeVehiclePrice v
                                    ORDER BY v.updated ASC')
                    ->getResult();
    }

    /**
     * Save a price object.
     **/
    public function savePrice(FipeVehiclePrice $price){
        $em = $this->getEntityManager();
        $em->persist($price);
        $em->flush();
    }

    public function findNoPriceVehicles(){
        return $this->getEntityManager()
            ->createQuery('SELECT y, t FROM SyclassFipeBundle:FipeVehicleYear y
                JOIN y.tables t
            	LEFT JOIN y.prices p WITH p.table = t.id
            	WHERE p.id IS NULL
            ')
            ->setMaxResults(self::LIMIT)
            ->getResult()
        ;
    }

    public function countNoPricedByManufacturer(){
        return $this->getEntityManager()
            ->createQuery('SELECT m.id, m.name, m.slug, m.logo, COUNT(1) total FROM SyclassFipeBundle:FipeVehicle v
            	JOIN v.manufacturer m
            	JOIN v.years y
                JOIN v.tables t
            	LEFT JOIN y.prices p WITH p.table = t.id
            	WHERE p.id IS NULL
                GROUP BY m.id, m.name, m.slug, m.logo
                ORDER BY total DESC
            ')
            ->getResult();
    }

    public function countNoPricedByVehicle($slug){
        return $this->getEntityManager()
            ->createQuery('SELECT v.id, v.name,v.slug,m.id as man_id, m.slug as man_slug, m.logo as man_logo, COUNT(1) total
                FROM SyclassFipeBundle:FipeVehicle v
            	JOIN v.manufacturer m
            	JOIN v.years y
                JOIN v.tables t
            	LEFT JOIN y.prices p WITH p.table = t.id
            	WHERE p.id IS NULL
                AND m.slug = :slug
                GROUP BY v.id, v.name, v.slug, m.id, m.name, m.logo
                ORDER BY total DESC
            ')
            ->setParameter('slug', $slug)
            ->getResult();
    }

    public function listPricesByVehicle($slug){
        return $this->getEntityManager()
            ->createQuery('SELECT v,m,y,t
                FROM SyclassFipeBundle:FipeVehicle v
            ')
            	// JOIN v.manufacturer m
            	// JOIN v.years y
                // JOIN v.tables t
            	// LEFT JOIN y.prices p WITH p.table = t.id
            	// WHERE m.slug = :slug
            // ->setParameter('slug', $slug)
            ->getFirstResult(\Doctrine\ORM\Query::HYDRATE_ARRAY)
        ;
    }

    public function listNoPriced($slug){
        return $this->getEntityManager()
            ->createQuery('SELECT v,m,y,t
                FROM SyclassFipeBundle:FipeVehicle v
            	JOIN v.manufacturer m
            	JOIN v.years y
                JOIN v.tables t
            	LEFT JOIN y.prices p WITH p.table = t.id
            	WHERE p.id IS NULL
                AND v.slug = :slug
            ')
            ->setParameter('slug', $slug)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    public function listTableNoPriced($slug, $table){
        return $this->getEntityManager()
            ->createQuery('SELECT v,m,y,t
                FROM SyclassFipeBundle:FipeVehicle v
            	JOIN v.manufacturer m
            	JOIN v.years y
                JOIN v.tables t
            	LEFT JOIN y.prices p WITH p.table = t.id
            	WHERE p.id IS NULL
                AND v.slug = :slug
                AND y.slug = :year
                AND t.id = :table
            ')
            ->setParameter('slug', $slug)
            ->setParameter('year', $year)
            ->setParameter('table', $table)
            ->getResult();
    }

    public function listTablePrices($vehicle, $table){
        return $this->getEntityManager()
            ->createQuery('SELECT p, t, y
                FROM SyclassFipeBundle:FipeVehiclePrice p
                JOIN p.table t
                JOIN p.year y
                JOIN p.vehicle v
            	WHERE v.id = :vehicle
                AND t.id = :table
            ')
                //WITH p.table = t.id
            ->setParameter('vehicle', $vehicle->getId())
            ->setParameter('table', $table->getId())
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY)
        ;
    }

    public function listAllNoPriced(){
        return $this->getEntityManager()
            ->createQuery('SELECT v, m, y, t FROM SyclassFipeBundle:FipeVehicleYear y
                JOIN y.tables t
                LEFT JOIN y.prices p WITH p.table = t.id
                JOIN y.vehicle v
                JOIN v.manufacturer m
                WHERE p.id IS NULL
            ')
            ->setMaxResults(self::LIMIT)
            ->getResult()
        ;
    }

    public function find12MonthsVehicle(FipeVehicle $vehicle){
        $month = new \DateTime();
        $month->sub(new \DateInterval('P1Y'));

        if(!$vehicle instanceof FipeVehicle){
            return false;
        }

        return $this->getEntityManager()
            ->createQuery('SELECT v, y, p, t, t2 FROM SyclassFipeBundle:FipeVehicle v
                JOIN v.years y
                JOIN y.prices p
                JOIN v.tables t2
                JOIN p.table t WITH p.table = t2.id
            	WHERE v.id = :vehicle
                AND t.month > :month
                ORDER BY y.name, t.id
            ')
            ->setParameters(Array(
                'vehicle' => $vehicle->getId(),
                'month'   => $month
            ))
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }
}
