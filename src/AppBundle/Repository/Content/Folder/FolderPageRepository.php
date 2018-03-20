<?php

namespace HGT\AppBundle\Repository\Content\Folder;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\Folder\FolderPage;

class FolderPageRepository extends ServiceEntityRepository
{
    /**
     * FolderPageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FolderPage::class);
    }

    /**
     * @param $id
     * @return FolderPage|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param FolderPage $folderPage
     */
    public function add(FolderPage $folderPage)
    {
        $this->getEntityManager()->persist($folderPage);
    }

    /**
     * @param FolderPage $folderPage
     */
    public function remove(FolderPage $folderPage)
    {
        $this->getEntityManager()->remove($folderPage);
    }

    /**
     * @param $folder_id
     * @return array
     */
    public function getFolderPagesByFolderId($folder_id)
    {
        $qb = $this->createQueryBuilder('q');
        $qb->where('q.folder = :identifier')
            ->setParameter('identifier', $folder_id);
        $qb->orderBy('q.priority', 'DESC');
        return $qb->getQuery()->getResult();
    }
}
