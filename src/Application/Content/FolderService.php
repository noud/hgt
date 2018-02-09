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
}
