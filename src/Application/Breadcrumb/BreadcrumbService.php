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
    public function addBreadcrumb($name, $url) {
        $counter = count($this->breadcrumbs);
        $this->breadcrumbs[$counter]['name'] = $name;
        $this->breadcrumbs[$counter]['url'] = $url;
    }

    /**
     * @return array
     */
    public function getBreadcrumbs() {
        return array_reverse($this->breadcrumbs);
    }
}