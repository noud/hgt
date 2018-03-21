<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Catalog\Category\CategoryRepository;

class MenuService
{
    protected $cache;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * ConfigService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return array
     */
    public function getCategoriesForMenu()
    {
        $categories = $this->categoryRepository->getCategoriesWithProducts("NULL");
        $itemsPerList = ceil(count($categories) / 2);

        $left_categories = array();
        $right_categories = array();

        $i = 1;

        foreach ($categories as $category) {
            if ($i <= $itemsPerList) {
                $left_categories[] = $category;
            } else {
                $right_categories[] = $category;
            }
            $i++;
        }

        return [
            'hasItems' => (count($left_categories) + count($right_categories)) > 0 ? true : false,
            'left_categories' => $left_categories,
            'right_categories' => $right_categories,
        ];
    }
}
