<?php

namespace HGT\AppBundle\Repository\Content\Page;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\Page\PageType;

class PageTypeRepository extends ServiceEntityRepository
{
    /**
     * PageTypeRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageType::class);
    }

    /**
     * @param $id
     * @return PageType|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param PageType $pageType
     */
    public function add(PageType $pageType)
    {
        $this->getEntityManager()->persist($pageType);
    }

    /**
     * @param PageType $pageType
     */
    public function remove(PageType $pageType)
    {
        $this->getEntityManager()->remove($pageType);
    }
}
