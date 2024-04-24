<?php

namespace App\Repository;

use App\Entity\RecipesType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecipesType>
 *
 * @method RecipesType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipesType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipesType[]    findAll()
 * @method RecipesType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipesTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipesType::class);
    }

    //    /**
    //     * @return RecipesType[] Returns an array of RecipesType objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RecipesType
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
