<?php

namespace App\Repository;

use App\Entity\Caller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Caller>
 *
 * @method Caller|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caller|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caller[]    findAll()
 * @method Caller[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CallerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caller::class);
    }

//    /**
//     * @return Caller[] Returns an array of Caller objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Caller
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
