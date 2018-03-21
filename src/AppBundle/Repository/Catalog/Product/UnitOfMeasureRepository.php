<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Product\UnitOfMeasure;

class UnitOfMeasureRepository extends ServiceEntityRepository
{
    /**
     * UnitOfMeasureRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnitOfMeasure::class);
    }

    /**
     * @param $id
     * @return UnitOfMeasure|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param UnitOfMeasure $unitOfMeasure
     */
    public function add(UnitOfMeasure $unitOfMeasure)
    {
        $this->getEntityManager()->persist($unitOfMeasure);
    }

    /**
     * @param UnitOfMeasure $unitOfMeasure
     */
    public function remove(UnitOfMeasure $unitOfMeasure)
    {
        $this->getEntityManager()->remove($unitOfMeasure);
    }
}
