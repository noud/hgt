<?php

namespace HGT\Application\Breadcrumb;

class BreadcrumbService
{
    /**
     * @var array
     */
    private $breadcrumbs;

    public function addBreadcrumb($name, $url) {
        $counter = count($this->breadcrumbs);
        $this->breadcrumbs[$counter]['name'] = $name;
        $this->breadcrumbs[$counter]['url'] = $url;
    }

    public function getBreadcrumbs() {
        return $this->breadcrumbs;
    }
}