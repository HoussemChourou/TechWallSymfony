<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends ServiceEntityRepository<Personne>
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    /**
     * @return Personne[] Returns an array of Personne objects
     */
    public function findPersonneByAgeInterval($ageMin,$ageMax)
    {
        $qb= $this->createQueryBuilder('p');
        $qb=$this->addIntervalAge($qb,$ageMin,$ageMax);
           return $qb->getQuery()
            ->getResult()
        ;
    }

    private function addIntervalAge(QueryBuilder $qb,$ageMin,$ageMax){
            return $qb->andWhere('p.age <= :ageMax and p.age >= :ageMin')
            ->setParameter('ageMax', $ageMax)
            ->setParameter('ageMin', $ageMin);
    }

    public function statsPersonneByAgeInterval($ageMin,$ageMax)
    {
        $qb=$this->createQueryBuilder('p')
            ->select('avg(p.age) as ageMoyen,count(p.id) as nbPersonne');
        $qb=$this->addIntervalAge($qb,$ageMin,$ageMax);
            return $qb->getQuery()
            ->getScalarResult()
            ;
    }

//    public function findOneBySomeField($value): ?Personne
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
