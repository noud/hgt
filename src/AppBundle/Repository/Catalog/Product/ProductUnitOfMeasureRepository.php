<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;
use HGT\Application\Catalog\Product\UnitOfMeasure;

class ProductUnitOfMeasureRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductUnitOfMeasure|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param ProductUnitOfMeasure $productUnitOfMeasure
     */
    public function add(ProductUnitOfMeasure $productUnitOfMeasure)
    {
        $this->getEntityManager()->persist($productUnitOfMeasure);
    }

    /**
     * @param ProductUnitOfMeasure $productUnitOfMeasure
     */
    public function remove(ProductUnitOfMeasure $productUnitOfMeasure)
    {
        $this->getEntityManager()->remove($productUnitOfMeasure);
    }

    /**
     * @param Product $product
     * @return array|ProductUnitOfMeasure[]
     */
    public function getProductUnitOfMeasureByProductId(Product $product)
    {
        return $this->findBy(
            ['product' => $product->getId()]
        );
    }

    /**
     * @param Product $product
     * @param UnitOfMeasure $unit_of_measure
     * @return ProductUnitOfMeasure|null|object
     */
    public function getProductUnitOfMeasureForProductPrice(Product $product, UnitOfMeasure $unit_of_measure)
    {
        return $this->findOneBy(
            [
                'product' => $product->getId(),
                'unit_of_measure' => $unit_of_measure->getId()
            ]
        );
    }

    /**
     * @param Product $product
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilderForProductUnitOfMeasures(Product $product)
    {
        $queryBuilder = $this->createQueryBuilder('q');
        $queryBuilder->where('q.product = :productId');
        $queryBuilder->setParameter('productId', $product->getId());

//        $queryBuilder = $this->createQueryBuilder('q');
//        $queryBuilder->select('u.id', 'u.name', 'u.navision_id');
//        $queryBuilder->join('q.unit_of_measure', 'u');
//        $queryBuilder->where('q.product = :productId');
//        $queryBuilder->setParameter('productId', $product->getId());
//        dump($queryBuilder->getQuery()->getSQL());

        return $queryBuilder;
    }
}
