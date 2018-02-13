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

    /**
     * @return array
     */
    public function getHomeCategories()
    {
        return $this->categoryRepository->getHomeCategories();
    }

    /**
     * @param string $id
     * @return array
     */
    public function getCategoriesWithProducts($id = "NULL")
    {
        return $this->categoryRepository->getCategoriesWithProducts($id);
    }

    /**
     * @param int $id
     * @return Category\Category
     */
    public function get($id = 0)
    {
        return $this->categoryRepository->get($id);
    }
}
