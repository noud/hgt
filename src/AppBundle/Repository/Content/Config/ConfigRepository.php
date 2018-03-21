<?php

namespace HGT\AppBundle\Repository\Content\Config;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Content\Config\Config;

class ConfigRepository extends ServiceEntityRepository
{
    /**
     * ConfigRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Config::class);
    }

    /**
     * @param $id integer
     * @return Config|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Config $config
     */
    public function add(Config $config)
    {
        $this->getEntityManager()->persist($config);
    }

    /**
     * @param Config $config
     */
    public function remove(Config $config)
    {
        $this->getEntityManager()->remove($config);
    }

    /**
     * @param $name string
     * @return Config|object
     */
    public function getConfigByName($name)
    {
        return $this->findOneBy([
            'name' => $name
        ]);
    }
}
