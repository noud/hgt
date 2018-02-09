<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Page\PageRepository;

class PageService
{
    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * PageService constructor.
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }
}
