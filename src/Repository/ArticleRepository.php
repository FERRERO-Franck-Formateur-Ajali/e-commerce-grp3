<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Souscategorie;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findArticle($nom,$cate)
    {
        return $this->createQueryBuilder('a')
            ->join(Souscategorie::class, 's', 'WITH', 's.id=a.souscategorie')
            ->join(Categorie::class, 'c', 'WITH', 'c.id=s.categorie')
            ->andWhere('s.nom = :nom')
            ->andWhere('c.nom = :cat')
            ->setParameter('nom', $nom)
            ->setParameter('cat', $cate)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
        // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function findTitle($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.nom = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
            // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function findColor($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.couleur = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
            // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function findDescription($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.description = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
                // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function findPrice($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.prix = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Article
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
