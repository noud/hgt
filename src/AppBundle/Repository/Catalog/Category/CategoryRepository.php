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

    public function getHomeCategories()
    {
        $qb = $this->createQueryBuilder('q');

        $qb->where('q.show_homepage = :show_homepage')
            ->andWhere('q.total_product_count > :total_product_count')
            ->setParameters([
                'show_homepage' => 1,
                'total_product_count' => 0,
            ]);
        $qb->orderBy('q.name', 'ASC');

        return $qb->getQuery()->getResult();
    }
}