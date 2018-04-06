<?php

namespace HGT\AppBundle\Repository\Catalog\Manufacture;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Manufacture\Manufacturer;

class ManufacturerRepository extends ServiceEntityRepository
{
    /**
     * ManufacturerRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manufacturer::class);
    }

    /**
     * @param $id
     * @return Manufacturer|null|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Manufacturer $manufacturer
     */
    public function add(Manufacturer $manufacturer)
    {
        $this->getEntityManager()->persist($manufacturer);
    }

    /**
     * @param Manufacturer $manufacturer
     */
    public function remove(Manufacturer $manufacturer)
    {
        $this->getEntityManager()->remove($manufacturer);
    }

    /**
     * @param $query
     * @return Manufacturer[]
     */
    public function searchManufacturers($query)
    {
        $qb = $this->createQueryBuilder('q')
            ->where('q.name LIKE :term')
            ->orderBy('q.name', 'ASC')
            ->setParameter('term', '%' . urldecode($query) . '%');

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Manufacturer[]
     */
    public function getManufacturers()
    {
        return $this->findAll();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getManufactureWithProducts($name)
    {
        $queryBuilder = $this->createQueryBuilder('m');
        $queryBuilder->
        innerJoin('m.products', 'p')
            ->andWhere('m.name = :name')
            ->setParameter('name', $name)
            ->addSelect('p');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
