<?php

namespace App\Repository;

use App\Entity\GiftsUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Database;

/**
 * @extends ServiceEntityRepository<GiftsUser>
 *
 * @method GiftsUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method GiftsUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method GiftsUser[]    findAll()
 * @method GiftsUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiftsUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GiftsUser::class);
    }

    public function add(GiftsUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GiftsUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    function get_connection ()
    {
        return $this->getEntityManager()->getConnection();
    }

    public function fetch_users_from_table ($user)
    {
        $sql_cmd = "SELECT * FROM gifts_user WHERE NOT name='$user'";
        $db = new Database;
        return($db->prepare_execute_and_fetch($this->get_connection(), $sql_cmd));
    }

//    /**
//     * @return GiftsUser[] Returns an array of GiftsUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GiftsUser
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
