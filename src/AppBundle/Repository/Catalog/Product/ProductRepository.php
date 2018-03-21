<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use HGT\Application\Catalog\Category\Category;
use HGT\Application\Catalog\Product\Product;

class ProductRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Product|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Product $product
     */
    public function add(Product $product)
    {
        $this->getEntityManager()->persist($product);
    }

    /**
     * @param Product $product
     */
    public function remove(Product $product)
    {
        $this->getEntityManager()->remove($product);
    }

    /**
     * @param $query
     * @return Product[]
     */
    public function searchProducts($query)
    {
        $qb = $this->createQueryBuilder('q')
            ->where('q.name LIKE :term')
            ->orderBy('q.name', 'ASC')
            ->setParameter('term', '%' . urldecode($query) . '%');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param int $currentPage
     * @param int $perPage
     * @param string $query
     * @return Paginator
     */
    public function getPagedProducts($currentPage, $perPage, $query)
    {
        $qb = $this->createQueryBuilder('q')
            ->where('q.name LIKE :term')
            ->orderBy('q.name', 'ASC')
            ->setParameter('term', '%' . urldecode($query) . '%');

        $paginator = new Paginator($qb->getQuery());
        $paginator->getQuery()
            ->setFirstResult($perPage * ($currentPage - 1)) // Offset
            ->setMaxResults($perPage); // Limit

        return $paginator;
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @param Category $category
     *
     * @return Paginator
     */
    public function getPagedCategoryProducts($currentPage, $perPage, Category $category)
    {
        $qb = $this->createQueryBuilder('q')
            ->innerJoin('q.categories', 'c')
            ->where('c.id IN(:categories)')
            ->setParameter('categories', [$category])
            ->orderBy('q.name', 'ASC');

        $paginator = new Paginator($qb->getQuery());
        $paginator->getQuery()
            ->setFirstResult($perPage * ($currentPage - 1)) // Offset
            ->setMaxResults($perPage); // Limit

        return $paginator;
    }
}
