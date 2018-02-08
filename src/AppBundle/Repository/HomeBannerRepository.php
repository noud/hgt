<?php

namespace AppBundle\Repository;

use AppBundle\Entity\HomeBanner;
use Doctrine\ORM\EntityRepository;

class HomeBannerRepository extends EntityRepository
{
    /**
     * @param $id
     * @return HomeBanner
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param HomeBanner $homeBanner
     */
    public function add(HomeBanner $homeBanner)
    {
        $this->getEntityManager()->persist($homeBanner);
    }

    /**
     * @param HomeBanner $homeBanner
     */
    public function remove(HomeBanner $homeBanner)
    {
        $this->getEntityManager()->remove($homeBanner);
    }
}