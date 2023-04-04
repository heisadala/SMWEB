<?php

namespace App\Repository;

use App\Entity\LegoTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Database;

/**
 * @extends ServiceEntityRepository<LegoTable>
 *
 * @method LegoTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method LegoTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method LegoTable[]    findAll()
 * @method LegoTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegoTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LegoTable::class);
    }

    public function add(LegoTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LegoTable $entity, bool $flush = false): void
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
//    /**
//     * @return LegoTable[] Returns an array of LegoTable objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LegoTable
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
