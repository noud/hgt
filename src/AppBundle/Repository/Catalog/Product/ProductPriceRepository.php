<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\ProductPrice;
use HGT\Application\Catalog\Product\UnitOfMeasure;

class ProductPriceRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return ProductPrice|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param ProductPrice $productPrice
     */
    public function add(ProductPrice $productPrice)
    {
        $this->getEntityManager()->persist($productPrice);
    }

    /**
     * @param ProductPrice $productPrice
     */
    public function remove(ProductPrice $productPrice)
    {
        $this->getEntityManager()->remove($productPrice);
    }

    /**
     * @param Product $product
     * @param UnitOfMeasure $unit_of_measure
     * @param bool $is_action_price
     * @param \DateTime $date
     * @return array|ProductPrice[]
     */
    public function getActiveProductPrices(
        Product $product,
        UnitOfMeasure $unit_of_measure,
        $is_action_price = null,
        $date = null
    ) {
        if ($date === null) {
            $date = date("Y-m-d");
        }

        $qb = $this->createQueryBuilder('q');
        $qb->where('q.product = :product_id')
            ->andWhere('q.unit_of_measure = :unit_of_measure_id')
            ->andWhere(':date BETWEEN q.start_date AND q.end_date OR (q.start_date <= :date AND q.end_date IS NULL)');

        if ($date !== null) {
            $qb->andWhere('q.is_action_price = :is_action_price');
        }

        $qb->setParameters([
            'product_id' => $product->getId(),
            'unit_of_measure_id' => $unit_of_measure->getId(),
            'date' => $date,
            'is_action_price' => $is_action_price
        ]);

        $qb->orderBy('q.is_action_price');

        return $qb->getQuery()->getResult();
    }
}
