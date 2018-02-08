<?php

namespace AppBundle\Service;

use AppBundle\Repository\PageTypeRepository;

class PageTypeService
{
    /**
     * @var PageTypeRepository
     */
    private $pageTypeRepository;

    /**
     * PageTypeService constructor.
     * @param PageTypeRepository $pageTypeRepository
     */
    public function __construct(PageTypeRepository $pageTypeRepository)
    {
        $this->pageTypeRepository = $pageTypeRepository;
    }
}