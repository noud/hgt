<?php

namespace HGT\AppBundle\Repository\Content\News;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\News\News;

class NewsRepository extends ServiceEntityRepository
{
    /**
     * NewsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

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

    /**
     * @param $query
     * @return News[]
     */
    public function searchNews($query)
    {
        $qb = $this->createQueryBuilder('q')
            ->where('q.description LIKE :term')
            ->orderBy('q.start_date', 'DESC')
            ->setParameter('term', '%' . urldecode($query) . '%');

        return $qb->getQuery()->getResult();
    }
}
