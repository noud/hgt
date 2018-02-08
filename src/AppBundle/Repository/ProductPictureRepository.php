<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ProductPicture;
use Doctrine\ORM\EntityRepository;

class ProductPictureRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductPicture
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