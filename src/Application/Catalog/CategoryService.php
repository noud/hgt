<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Category\CategoryRepository;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getHomeCategories()
    {
        return $this->categoryRepository->getHomeCategories();
    }
}
