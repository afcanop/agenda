<?php

namespace App\Repository\Agenda;

use App\Entity\Agenda\Evento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evento[]    findAll()
 * @method Evento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evento::class);
    }

    public function lista()
    {
        return $this->createQueryBuilder('e')
            ->select('e.id')
            ->addSelect('e.nombre')
            ->addSelect('e.fechaInicio')
            ->addSelect('e.fechaFin')
            ->addSelect('e.descripcion')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }


    /*
    public function findOneBySomeField($value): ?Evento
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
