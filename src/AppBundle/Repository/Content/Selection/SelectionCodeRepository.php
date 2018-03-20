<?php

namespace HGT\AppBundle\Repository\Content\Selection;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\SelectionCode\SelectionCode;

class SelectionCodeRepository extends ServiceEntityRepository
{
    /**
     * SelectionCodeRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectionCode::class);
    }

    /**
     * @param $id
     * @return SelectionCode|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param SelectionCode $selectionCode
     */
    public function add(SelectionCode $selectionCode)
    {
        $this->getEntityManager()->persist($selectionCode);
    }

    /**
     * @param SelectionCode $selectionCode
     */
    public function remove(SelectionCode $selectionCode)
    {
        $this->getEntityManager()->remove($selectionCode);
    }
}
