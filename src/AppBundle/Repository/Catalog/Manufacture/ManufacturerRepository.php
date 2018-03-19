<?php

namespace HGT\AppBundle\Repository\Catalog\Manufacture;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Manufacture\Manufacturer;

class ManufacturerRepository extends EntityRepository
{
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
     * @return Manufacturer[]
     */
    public function getManufacturersWithProducts()
    {
        $qb = $this->createQueryBuilder('q');
        $qb->where('q.total_product_count > 0')
            ->orderBy('q.name', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
