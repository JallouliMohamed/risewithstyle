<?php

namespace App\Repository;

use App\Entity\Fashionboard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fashionboard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fashionboard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fashionboard[]    findAll()
 * @method Fashionboard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FashionboardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fashionboard::class);
    }
    public function getUsers(){
        return $this->createQueryBuilder('a')
            ->Where('a.adminValidation = true')
            ->groupBy('a.user')
            ->getQuery()
            ->getResult();
    }
    public function findByUser( $value){
        return $this->createQueryBuilder('a')
            ->andWhere('a.clientActivation = true')
            ->andWhere('a.adminValidation = false')
            ->andWhere('a.user = :id')
            ->setParameter('id', $value)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Fashionboard[] Returns an array of Fashionboard objects
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
    public function findOneBySomeField($value): ?Fashionboard
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
