<?php

namespace App\Repository;

use App\Entity\CarsCtTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Database;

/**
 * @extends ServiceEntityRepository<CarsCtTable>
 *
 * @method CarsCtTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarsCtTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarsCtTable[]    findAll()
 * @method CarsCtTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsCtTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarsCtTable::class);
    }

    public function add(CarsCtTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarsCtTable $entity, bool $flush = false): void
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
//     * @return CarsCtTable[] Returns an array of CarsCtTable objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarsCtTable
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
