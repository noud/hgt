<?php

namespace HGT\AppBundle\Repository\Content\News;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\News\News;

class NewsRepository extends EntityRepository
{
    /**
     * @param $id
     * @return News|object
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
