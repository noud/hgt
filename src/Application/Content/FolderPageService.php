<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Folder\FolderPageRepository;

class FolderPageService
{
    /**
     * @var FolderPageRepository
     */
    private $folderPageRepository;

    /**
     * FolderPageService constructor.
     * @param FolderPageRepository $folderPageRepository
     */
    public function __construct(FolderPageRepository $folderPageRepository)
    {
        $this->folderPageRepository = $folderPageRepository;
    }

    /**
     * @param $id
     * @return Folder\FolderPage|object
     */
    public function get($id)
    {
        return $this->folderPageRepository->get($id);
    }

    public function getFolderPageById()
    {

    }

    public function getFolderPagesByFolderId($folder_id)
    {
        return $this->folderPageRepository->getFolderPagesByFolderId($folder_id);
    }



}
