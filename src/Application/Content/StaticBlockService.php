<?php

namespace HGT\Application\Content;

use HGT\AppBundle\Repository\Content\StaticBlock\StaticBlockRepository;

class StaticBlockService
{
    /**
     * @var StaticBlockRepository
     */
    private $staticBlockRepository;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * StaticBlockService constructor.
     * @param \Twig_Environment $twig
     * @param StaticBlockRepository $staticBlockRepository
     */
    public function __construct(\Twig_Environment $twig, StaticBlockRepository $staticBlockRepository)
    {
        $this->staticBlockRepository = $staticBlockRepository;
        $this->twig = $twig;
    }

    /**
     * @param $identifier string
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Exception
     */
    public function getByIdentifier($identifier)
    {
        $staticBlock = $this->staticBlockRepository->getByIdentifier($identifier);

        if ($staticBlock === null) {
            throw new \Exception("Static block '" . $identifier . "' not found.");
        }

        return $this->twig->render('_partials/staticblock.html.twig', [
            'staticBlock' => $staticBlock,
        ]);
    }
}
