<?php

namespace HGT\AppBundle\Repository\Content\Home;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Home\HomeBanner;

class HomeBannerRepository extends EntityRepository
{
    /**
     * @param $id
     * @return HomeBanner|object
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

    /**
     * @param int $limit
     * @return HomeBanner[]
     */
    public function getHomeBanners($limit)
    {
        $qb = $this->createQueryBuilder('q');

        $qb->orderBy('q.priority', 'DESC')
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }
}
