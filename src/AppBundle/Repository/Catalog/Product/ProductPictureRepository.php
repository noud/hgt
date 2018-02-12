<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\ProductPicture;

class ProductPictureRepository extends EntityRepository
{
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
