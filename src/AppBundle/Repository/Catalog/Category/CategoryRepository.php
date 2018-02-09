<?php

namespace HGT\AppBundle\Repository\Catalog\Category;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Category\Category;

class CategoryRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Category
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Category $category
     */
    public function add(Category $category)
    {
        $this->getEntityManager()->persist($category);
    }

    /**
     * @param Category $category
     */
    public function remove(Category $category)
    {
        $this->getEntityManager()->remove($category);
    }
}
