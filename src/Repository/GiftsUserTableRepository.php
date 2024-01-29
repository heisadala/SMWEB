<?php

namespace App\Repository;

use App\Entity\GiftsUserTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Database;

/**
 * @extends ServiceEntityRepository<GiftsUserTable>
 *
 * @method GiftsUserTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method GiftsUserTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method GiftsUserTable[]    findAll()
 * @method GiftsUserTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiftsUserTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GiftsUserTable::class);
    }

    public function add(GiftsUserTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function flush(GiftsUserTable $entity): void
    {

        $this->getEntityManager()->flush();

    }

    public function remove(GiftsUserTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /*
  ADDED FUNCTIONS
*/
    function get_connection ()
    {
        return $this->getEntityManager()->getConnection();
    }
    public function fetch_header_fields_from_table($table_name): array
    {
        $db = new Database;
        return ($db->fetch_header_fields_from_table($this->get_connection(), $table_name));
    }

    public function get_pk_name($table_name): string
    {
        $db = new Database;
        return ($db->get_pk_name($this->get_connection(), $table_name));
    }

    public function fetch_class_from_table_ordered ($table_name, $ordered_by, $sort_order)
    {
        $db = new Database;
        return ($db->fetch_class_from_table_ordered($this->get_connection(), $table_name, 
                                                    $ordered_by, $sort_order));

    }
    public function fetch_class_from_table_filter_and_ordered ($table_name, $user, $ordered_by, $sort_order)
    {
        $db = new Database;
        return ($db->fetch_class_from_table_filter_and_ordered($this->get_connection(), $table_name, 
                                                    $user, $ordered_by, $sort_order));

    }
//    /**
//     * @return GiftsUserTable[] Returns an array of GiftsUserTable objects
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

//    public function findOneBySomeField($value): ?GiftsUserTable
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
