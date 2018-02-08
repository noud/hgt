<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Folder;
use Doctrine\ORM\EntityRepository;

class FolderRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Folder
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
}
