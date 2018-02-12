<?php

namespace HGT\AppBundle\Repository\Content\Home;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Home\HomeSlide;

class HomeSlideRepository extends EntityRepository
{
    /**
     * @param $id
     * @return HomeSlide|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param HomeSlide $homeSlide
     */
    public function add(HomeSlide $homeSlide)
    {
        $this->getEntityManager()->persist($homeSlide);
    }

    /**
     * @param HomeSlide $homeSlide
     */
    public function remove(HomeSlide $homeSlide)
    {
        $this->getEntityManager()->remove($homeSlide);
    }

    /**
     * @return HomeSlide[]
     */
    public function getHomeSlides()
    {
        $qb = $this->createQueryBuilder('q');

        $qb->where('q.date_from <= CURRENT_DATE()')
            ->andWhere('q.date_to >= CURRENT_DATE() OR q.date_to IS NULL');

        $qb->orderBy('q.priority', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
