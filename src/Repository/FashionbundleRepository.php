<?php

namespace App\Repository;

use App\Entity\Fashionbundle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fashionbundle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fashionbundle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fashionbundle[]    findAll()
 * @method Fashionbundle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FashionbundleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fashionbundle::class);
    }

    // /**
    //  * @return Fashionbundle[] Returns an array of Fashionbundle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fashionbundle
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
