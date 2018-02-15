<?php

namespace HGT\AppBundle\Repository\Content\Config;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Content\Config\Config;

class ConfigRepository extends EntityRepository
{
    /**
     * @param $id integer
     * @return null|Config
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
     * @return null|Config
     */
    public function getConfigByName($name)
    {
        return $this->findOneBy([
            'name' => $name
        ]);
    }
}
