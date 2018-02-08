<?php

namespace AppBundle\Repository;

use AppBundle\Entity\HomeSlide;
use Doctrine\ORM\EntityRepository;

class HomeSlideRepository extends EntityRepository
{
    /**
     * @param $id
     * @return HomeSlide
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
