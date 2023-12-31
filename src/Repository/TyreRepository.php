<?php

namespace App\Repository;

use App\Entity\Tyre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tyre>
 *
 * @method Tyre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tyre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tyre[]    findAll()
 * @method Tyre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TyreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tyre::class);
    }

    public function save(Tyre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tyre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchTyreByAll($tyreToSearch){
        $qb = $this->createQueryBuilder('t');

        $qb
            ->andWhere('t.width = :width')
            ->andWhere('t.height = :height')
            ->andWhere('t.season = :season')
            ->andWhere('t.diameter = :diameter')
            ->setParameter('width', $tyreToSearch['width'])
            ->setParameter('height', $tyreToSearch['height'])
            ->setParameter('diameter', $tyreToSearch['diameter'])
            ->setParameter('season', $tyreToSearch['season']);
        // ->setMaxResults(10);

        return $qb->getQuery()->getResult();

    }

//    /**
//     * @return Tyre[] Returns an array of Tyre objects
//     */
//    public function findByExampleField($value): array
//    {
    //    return $this->createQueryBuilder('t')
    //        ->andWhere('t.exampleField = :val')
    //        ->setParameter('val', $value)
    //        ->orderBy('t.id', 'ASC')
    //        ->setMaxResults(10)
    //        ->getQuery()
    //        ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tyre
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
