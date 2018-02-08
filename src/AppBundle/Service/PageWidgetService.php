<?php

namespace AppBundle\Service;

use AppBundle\Repository\PageWidgetRepository;

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