<?php

namespace AppBundle\Service;

use AppBundle\Repository\RewriteRepository;

class RewriteService
{
    /**
     * @var RewriteRepository
     */
    private $rewriteRepository;

    /**
     * RewriteService constructor.
     * @param RewriteRepository $rewriteRepository
     */
    public function __construct(RewriteRepository $rewriteRepository)
    {
        $this->rewriteRepository = $rewriteRepository;
    }
}