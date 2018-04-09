<?php

namespace HGT\Application\Breadcrumb;

class BreadcrumbService
{
    /**
     * @var array
     */
    private $breadcrumbs;

    /**
     * @param $name
     * @param $url
     */
    public function addBreadcrumb($name, $url)
    {
        $this->breadcrumbs[] = array('name' => $name, 'url' => $url);
    }

    /**
     * @return array
     */
    public function getBreadcrumbs()
    {
        return array_reverse($this->breadcrumbs);
    }
}
