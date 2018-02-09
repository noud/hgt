<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Page\PageWidgetRepository;

class PageWidgetService
{
    /**
     * @var PageWidgetRepository
     */
    private $pageWidgetRepository;

    /**
     * PageWidgetService constructor.
     * @param PageWidgetRepository $pageWidgetRepository
     */
    public function __construct(PageWidgetRepository $pageWidgetRepository)
    {
        $this->pageWidgetRepository = $pageWidgetRepository;
    }
}
