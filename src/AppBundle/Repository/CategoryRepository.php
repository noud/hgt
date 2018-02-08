<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

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