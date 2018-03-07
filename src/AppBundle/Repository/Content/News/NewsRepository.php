<?php

namespace HGT\AppBundle\Repository\Content\News;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\News\News;

class NewsRepository extends EntityRepository
{

    /**
     * @param $id
     * @return News|null|object
     */
    public function getNewsById($id)
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

    /**
     * @return News[]
     */
    public function getActiveNews()
    {

        $qb = $this->createQueryBuilder('q');
        $qb->where('q.start_date <= CURRENT_DATE()');
        $qb->orderBy('q.start_date', 'DESC');

        return $qb->getQuery()->getResult();

    }


}
