<?php

namespace HGT\Application\Content\Page;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Content\Page\PageWidgetRepository")
 * @ORM\Table(name="page_widget")
 */
class PageWidget
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\Page\Page", inversedBy="page_widget")
     * @ORM\JoinColumn(nullable=false)
     */
    private $page;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\Widget\Widget", inversedBy="page_widget")
     * @ORM\JoinColumn(nullable=false)
     */
    private $widget;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":900})
     */
    private $priority;
}
