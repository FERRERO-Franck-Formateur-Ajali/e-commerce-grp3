<?php

namespace App\Repository;

use App\Entity\Adresselivraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adresselivraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adresselivraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adresselivraison[]    findAll()
 * @method Adresselivraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdresselivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adresselivraison::class);
    }

    // /**
    //  * @return Adresselivraison[] Returns an array of Adresselivraison objects
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
    public function findOneBySomeField($value): ?Adresselivraison
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
