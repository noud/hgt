<?php

namespace HGT\AppBundle\Repository\Catalog\Category;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Category\Category;

class CategoryRepository extends ServiceEntityRepository
{
    /**
     * CategoryRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @param $id
     * @return Category|object
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

    /**
     * @param $parent_id
     * @return array
     */
    public function getCategoriesWithProducts($parent_id)
    {
        $qb = $this->createQueryBuilder('q');

        if ($parent_id === "NULL") {
            $qb->where('q.parent IS NULL');
        } else {
            $qb->where('q.parent = :parent_id')
                ->setParameter('parent_id', $parent_id);
        }

        $qb->andWhere('q.total_product_count > 0');
        $qb->orderBy('q.name', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
