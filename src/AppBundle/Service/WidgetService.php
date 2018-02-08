<?php

namespace AppBundle\Service;

use AppBundle\Repository\WidgetRepository;

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
