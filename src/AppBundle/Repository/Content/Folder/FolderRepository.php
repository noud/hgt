<?php

namespace HGT\AppBundle\Repository\Content\Folder;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\Folder\Folder;

class FolderRepository extends ServiceEntityRepository
{
    /**
     * FolderRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Folder::class);
    }

    /**
     * @param $id
     * @return Folder|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Folder $folder
     */
    public function add(Folder $folder)
    {
        $this->getEntityManager()->persist($folder);
    }

    /**
     * @param Folder $folder
     */
    public function remove(Folder $folder)
    {
        $this->getEntityManager()->remove($folder);
    }

    /**
     * @return array
     */
    public function getActiveFolders()
    {
        $qb = $this->createQueryBuilder('q');

        $qb->where('q.start_date <= CURRENT_DATE()')
            ->andWhere('q.end_date >= CURRENT_DATE()');

        $qb->orderBy('q.start_date', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
