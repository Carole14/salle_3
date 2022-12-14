<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Partenaires;
use App\Entity\Partners;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Partenaires>
 *
 * @method Partenaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partenaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partenaires[]    findAll()
 * @method Partenaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partners::class);
    }

    public function add(Partners $entity, bool $flush = false)
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            return $this->getEntityManager()->flush();
        }
    }

    public function remove(Partners $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Get parteners with query search
     * 
     */
    public function findSearch($search)
    {

        $query = $this
        ->createQueryBuilder('p');

        if(!empty($search)) {
            $query = $query
            ->andWhere('p.nom LIKE :q')
            ->setParameter('q', "%{$search}%");
        }
        return $query = $query->getQuery()->getResult();;
    }

//    /**
//     * @return Partenaires[] Returns an array of Partenaires objects
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

//    public function findOneBySomeField($value): ?Partenaires
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
