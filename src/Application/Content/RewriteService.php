<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\Rewrite\RewriteRepository;

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
