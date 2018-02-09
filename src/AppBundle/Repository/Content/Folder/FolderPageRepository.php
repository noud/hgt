<?php

namespace HGT\AppBundle\Repository\Content\Folder;

use Doctrine\ORM\EntityRepository;
use HTG\Application\Content\Folder\FolderPage;

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
}
