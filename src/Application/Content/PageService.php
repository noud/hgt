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

    /**
     * @param $id
     * @return Page\Page|object
     */
    public function get($id)
    {
        return $this->pageRepository->get($id);
    }
}
