<?php

namespace App\Repository;

use App\Entity\FormModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormModule>
 *
 * @method FormModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormModule[]    findAll()
 * @method FormModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormModule::class);
    }

//    /**
//     * @return FormModule[] Returns an array of FormModule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FormModule
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
