<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use HGT\Application\Catalog\Product\Product;

class ProductRepository extends ServiceEntityRepository
{
    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

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
}
