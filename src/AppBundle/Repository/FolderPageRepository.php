<?php

namespace AppBundle\Repository;

use AppBundle\Entity\FolderPage;
use Doctrine\ORM\EntityRepository;

class FolderPageRepository extends EntityRepository
{
    /**
     * @param $id
     * @return FolderPage
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
