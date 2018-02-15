<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Config\ConfigRepository;
use HGT\Application\Content\Config\Config;

class ConfigService
{
    protected $cache;

    /**
     * @var ConfigRepository
     */
    private $configRepository;

    /**
     * ConfigService constructor.
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function get($name, $default = null)
    {
        /** @var Config $configItem */
        $configItem = $this->configRepository->getConfigByName($name);

        if ($configItem instanceof Config) {
            return $configItem->getValue();
        }

        return $default;
    }
}
