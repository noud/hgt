<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use HGT\Application\Catalog\Category\Category;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;

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
            ->where('c.id = :categories')
            ->setParameter('categories', $category)
            ->orderBy('q.name', 'ASC');

        $paginator = new Paginator($qb->getQuery());
        $paginator->getQuery()
            ->setFirstResult($perPage * ($currentPage - 1)) // Offset
            ->setMaxResults($perPage); // Limit

        return $paginator;
    }

    /**
     * @param bool $loggedIn
     * @return Product[]
     */
    public function getActionProducts($loggedIn = false)
    {
        $subQuery = $this->_em->createQueryBuilder()
            ->from(ProductUnitOfMeasure::class, 'pum')
            ->select('IDENTITY(pum.unit_of_measure)')
            ->where('pum.product = p.id')
            ->getQuery();

        $query = $this->createQueryBuilder('p');
        $query->leftJoin('p.productPrices', 'pp')
            ->where('p.enabled = true')
            ->andWhere('pp.is_action_price = true')
            ->andWhere('pp.price_type = :global')
            ->setParameter('global','global')
            ->andWhere('pp.start_date <= CURRENT_DATE()')
            ->andWhere('pp.end_date >= CURRENT_DATE() OR pp.end_date IS NULL')
            ->andWhere($query->expr()->in('pp.unit_of_measure', $subQuery->getDQL()))
            ;

        if ($loggedIn) {
            $query->andWhere('pp.is_web_action = false');
        }

        return $query->getQuery()->getResult();
    }
}
