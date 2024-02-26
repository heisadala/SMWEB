<?php

namespace App\Repository;

use App\Entity\CarsFactureTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Database;

/**
 * @extends ServiceEntityRepository<CarsFactureTable>
 *
 * @method CarsFactureTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarsFactureTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarsFactureTable[]    findAll()
 * @method CarsFactureTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsFactureTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarsFactureTable::class);
    }

    public function add(CarsFactureTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarsFactureTable $entity, bool $flush = false): void
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

//    /**
//     * @return CarsFactureTable[] Returns an array of CarsFactureTable objects
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

//    public function findOneBySomeField($value): ?CarsFactureTable
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
