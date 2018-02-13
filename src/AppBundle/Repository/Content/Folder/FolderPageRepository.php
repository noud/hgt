<?php

namespace HGT\AppBundle\Repository\Content\Folder;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Folder\FolderPage;

class FolderPageRepository extends EntityRepository
{
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


    public function getFolderPageById()
    {

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
