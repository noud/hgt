<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Product\ProductPicture;

class ProductPictureRepository extends ServiceEntityRepository
{
    /**
     * ProductPictureRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductPicture::class);
    }

    /**
     * @param $id
     * @return ProductPicture|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param ProductPicture $productPicture
     */
    public function add(ProductPicture $productPicture)
    {
        $this->getEntityManager()->persist($productPicture);
    }

    /**
     * @param ProductPicture $productPicture
     */
    public function remove(ProductPicture $productPicture)
    {
        $this->getEntityManager()->remove($productPicture);
    }
}
