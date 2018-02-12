<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Widget\WidgetRepository;

class WidgetService
{
    /**
     * @var WidgetRepository
     */
    private $widgetRepository;

    /**
     * WidgetService constructor.
     * @param WidgetRepository $widgetRepository
     */
    public function __construct(WidgetRepository $widgetRepository)
    {
        $this->widgetRepository = $widgetRepository;
    }
}
