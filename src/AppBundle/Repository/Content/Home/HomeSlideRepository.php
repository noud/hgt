<?php

namespace HGT\AppBundle\Repository\Content\Home;

use Doctrine\ORM\EntityRepository;
use HTG\Application\Content\Home\HomeSlide;

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
}
