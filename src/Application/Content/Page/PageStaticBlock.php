<?php

namespace HGT\Application\Content\Page;

use Doctrine\ORM\Mapping as ORM;
use HGT\Application\Content\StaticBlock\StaticBlock;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Content\Page\PageStaticBlockRepository")
 * @ORM\Table(name="page_static_block")
 */
class PageStaticBlock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\Page\Page", inversedBy="page_static_block")
     */
    private $page;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\StaticBlock\StaticBlock", inversedBy="page_static_block")
     */
    private $staticBlock;

    /**
     * @ORM\Column(type="integer", options={"default":999})
     */
    private $sort;

    /**
     * @return StaticBlock
     */
    public function getStaticBlock()
    {
        return $this->staticBlock;
    }
}
