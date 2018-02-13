<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Category\CategoryRepository;
use HGT\Application\Catalog\Category\Category;

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
     * @param $parent_id
     * @return Category|null
     */
    public function getParentCategory($parent_id)
    {
        if($parent_id !== null) {
            return $this->categoryRepository->findOneById($parent_id);
        }

        return null;
    }

    /**
     * @param $category_id
     * @return Category[]
     */
    public function getSuperCategoriesWithProducts($category_id)
    {
        return $this->categoryRepository->getCategoriesWithProducts($category_id);
    }

    /**
     * @param int $id
     * @return Category
     */
    public function get($id = 0)
    {
        return $this->categoryRepository->get($id);
    }
}
