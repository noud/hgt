<?php

namespace AppBundle\Service;

use AppBundle\Repository\FolderPageRepository;

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
