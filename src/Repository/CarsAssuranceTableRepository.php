<?php

namespace App\Repository;

use App\Entity\CarsAssuranceTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Database;

/**
 * @extends ServiceEntityRepository<CarsAssuranceTable>
 *
 * @method CarsAssuranceTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarsAssuranceTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarsAssuranceTable[]    findAll()
 * @method CarsAssuranceTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsAssuranceTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarsAssuranceTable::class);
    }

    public function add(CarsAssuranceTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarsAssuranceTable $entity, bool $flush = false): void
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
    
//    /**
//     * @return CarsAssuranceTable[] Returns an array of CarsAssuranceTable objects
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

//    public function findOneBySomeField($value): ?CarsAssuranceTable
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
