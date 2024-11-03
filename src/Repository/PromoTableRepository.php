<?php

namespace App\Repository;

use App\Entity\PromoTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Database;

/**
 * @extends ServiceEntityRepository<PromoTable>
 *
 * @method PromoTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromoTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromoTable[]    findAll()
 * @method PromoTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoTable::class);
    }

    public function add(PromoTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PromoTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function archive(PromoTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        // dd($entity);
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
    public function fetch_class_from_table_all_ordered ($table_name, $archive, $userlist, $ordered_by, $sort_order)
    {
        $db = new Database;
        return ($db->fetch_class_from_table_all_ordered($this->get_connection(), $table_name, $archive,
                                                    $userlist, $ordered_by, $sort_order));

    }
    public function fetch_class_from_table_user_ordered ($table_name, $user, $archive, $ordered_by, $sort_order)
    {
        $db = new Database;
        return ($db->fetch_class_from_table_user_ordered($this->get_connection(), $table_name, $user,
                                                    $archive, $ordered_by, $sort_order));

    }

//    /**
//     * @return PromoTable[] Returns an array of PromoTable objects
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

//    public function findOneBySomeField($value): ?PromoTable
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
