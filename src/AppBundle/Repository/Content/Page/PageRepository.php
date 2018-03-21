<?php

namespace HGT\AppBundle\Repository\Content\Page;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\Page\Page;

class PageRepository extends ServiceEntityRepository
{
    /**
     * PageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }

    /**
     * @param $id
     * @return Page|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Page $page
     */
    public function add(Page $page)
    {
        $this->getEntityManager()->persist($page);
    }

    /**
     * @param Page $page
     */
    public function remove(Page $page)
    {
        $this->getEntityManager()->remove($page);
    }

    /**
     * @param Page $page
     * @return Page[]
     */
    public function getByParentId(Page $page)
    {
        return $this->findBy(
            ['parent' => $page]
        );
    }
}
