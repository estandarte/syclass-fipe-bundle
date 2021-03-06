<?php
namespace Syclass\FipeBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * ListingsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ListingsRepository extends EntityRepository {
    public function findListings() {
        return $this->getEntityManager()
                    ->createQuery('SELECT l,i FROM  SyclassFipeBundle:Listings l
                                    LEFT JOIN l.images i
                                    WHERE l.approved = :approved
                                    ORDER BY l.addedOn ASC')
                    ->setParameter(':approved', 1)
                    ->getResult();
    }
}
