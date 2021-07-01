<?php

namespace App\Repository;

use App\Entity\Adressefacturation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adressefacturation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adressefacturation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adressefacturation[]    findAll()
 * @method Adressefacturation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdressefacturationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adressefacturation::class);
    }

    // /**
    //  * @return Adressefacturation[] Returns an array of Adressefacturation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adressefacturation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
