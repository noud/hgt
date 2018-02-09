<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageWidgetRepository")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Page", inversedBy="page_widget")
     * @ORM\JoinColumn(nullable=false)
     */
    private $page;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Widget", inversedBy="page_widget")
     * @ORM\JoinColumn(nullable=false)
     */
    private $widget;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":900})
     */
    private $priority;
}
