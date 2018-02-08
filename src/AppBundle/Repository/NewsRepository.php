<?php

namespace AppBundle\Repository;

use AppBundle\Entity\News;
use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    /**
     * @param $id
     * @return News
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param News $news
     */
    public function add(News $news)
    {
        $this->getEntityManager()->persist($news);
    }

    /**
     * @param News $news
     */
    public function remove(News $news)
    {
        $this->getEntityManager()->remove($news);
    }
}
