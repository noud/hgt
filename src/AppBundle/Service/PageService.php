<?php

namespace AppBundle\Service;

use AppBundle\Repository\PageRepository;

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