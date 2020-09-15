<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    /*public function updateCartQuantity($quantity,$productId,$sessionId,)
	{
		 return $this->createQueryBuilder('u')
            ->update()
            ->set('u.quantity', '?1')
            ->setParameter(1, $qb->expr()->literal($quantity))
            ->where('u.id = ?2')
            ->setParameter(2, $qb->expr()->literal($userId))
			 ->where('u.id = ?2')
            ->setParameter(2, $qb->expr()->literal($userId))
            ->getQuery()
            ->getSingleScalarResult()
        ;
	}*/
}
