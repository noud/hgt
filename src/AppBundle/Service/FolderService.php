<?php

namespace AppBundle\Service;

use AppBundle\Repository\FolderRepository;

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