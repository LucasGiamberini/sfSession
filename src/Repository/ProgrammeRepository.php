<?php

namespace App\Repository;

use App\Entity\Programme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Programme>
 *
 * @method Programme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Programme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Programme[]    findAll()
 * @method Programme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Programme::class);
    }

    public function findDistinctCategoriesBySessionId($sessionId)
    {
        return $this->createQueryBuilder('s')
    ->select('c.nomCategorie')
    ->innerJoin('App\Entity\Programme', 'p', 'WITH', 'p.session = s')
    ->innerJoin('App\Entity\FormModule', 'f', 'WITH', 'f.id = p.module')
    ->innerJoin('App\Entity\Categorie', 'c', 'WITH', 'c.id = f.id_categorie')
    ->where('s.id = :sessionId')
    ->setParameter('sessionId', $sessionId)
    ->groupBy('c.id')
    ->getQuery()
    ->getResult();

    }
    
    // public function findByCategory( int $id){

    //     $em = $this->getEntityManager(); // get the EntityManager
    //     $sub = $em->createQueryBuilder(); // create a new QueryBuilder

    //     $qb=$sub;

    //     $qb ->select('ca.nomCategorie, mo.nomModule') 
    //         ->from('APP\Entity\Programme', 's')
            
    //         ->innerJoin('s.module', 'mo')
    //         ->innerJoin('mo.id_categorie', 'ca')
    //         ->where ('s.session = :id')
    //         ->setParameter('id', $id)
    //        // ->setMaxResults(1)
    //                         ;
    //         return $qb->getQuery()->getResult();    


    // }
   
//    /**
//     * @return Programme[] Returns an array of Programme objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Programme
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
