<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Page\PageTypeRepository;

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
