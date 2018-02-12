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
}
