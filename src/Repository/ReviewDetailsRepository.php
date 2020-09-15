<?php

namespace App\Repository;

use App\Entity\ReviewDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReviewDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReviewDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReviewDetails[]    findAll()
 * @method ReviewDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReviewDetails::class);
    }

    // /**
    //  * @return ReviewDetails[] Returns an array of ReviewDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReviewDetails
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
