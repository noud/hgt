<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Folder\FolderRepository;

class FolderService
{
    /**
     * @var FolderRepository
     */
    private $folderRepository;

    /**
     * FolderService constructor.
     * @param FolderRepository $folderRepository
     */
    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    /**
     * @param $id
     * @return Folder\Folder|object
     */
    public function getFolder($id)
    {
        return $this->folderRepository->get($id);
    }

    /**
     * @return array
     */
    public function getActiveFolders()
    {
        return $this->folderRepository->getActiveFolders();
    }


}
