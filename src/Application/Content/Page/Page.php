<?php

namespace HGT\Application\Content\Page;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Content\Page\PageRepository")
 * @ORM\Table(name="page")
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text", length=16777215)
     */
    private $content;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $meta_title;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $meta_keywords;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $meta_description;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\Page\Page", inversedBy="page")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $url_key;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $short_title;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $show_in_search;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\Page\PageType", inversedBy="page")
     */
    private $page_type;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":999})
     */
    private $sort;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $show_in_menu;
}
