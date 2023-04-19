<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Post[] Returns an array of Post objects
//     */
    public function findOrderDate(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(25)
            ->getQuery()
            ->getResult()
        ;
    }

    public function countTotalPost($user): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.user = :user')
            ->setParameter(':user', $user)
            ->getQuery()
            ->getScalarResult()
            ;
    }

    public function countLastWeekPost($user): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.user = :user')
            ->setParameter(':user', $user)
            ->andWhere('p.created_at >= :date')
            ->setParameter(':date', new \DateTimeImmutable('1 week ago'))
            ->getQuery()
            ->getScalarResult()
            ;
    }

//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.date', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//            ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
