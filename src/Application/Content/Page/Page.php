<?php

namespace HGT\Application\Content\Page;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Content\Page\PageRepository")
 * @ORM\Table(name="page")
 */
class Page
{
    /**
     * @ORM\OneToMany(targetEntity="HGT\Application\Content\Page\PageStaticBlock", mappedBy="page")
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    private $pageStaticBlocks;

    /**
     * @ORM\OneToMany(targetEntity="HGT\Application\Content\Page\Page", mappedBy="parent")
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    private $subPages;

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

    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->pageStaticBlocks = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * @return Page
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function getUrlKey()
    {
        return $this->url_key;
    }

    /**
     * @return string
     */
    public function getShortTitle()
    {
        return $this->short_title;
    }

    /**
     * @return bool
     */
    public function isShowInMenu()
    {
        return $this->show_in_menu;
    }

    /**
     * @return Page[]
     */
    public function getSubPages()
    {
        return $this->subPages;
    }

    /**
     * @return PageStaticBlock[]|ArrayCollection
     */
    public function getPageStaticBlocks()
    {
        return $this->pageStaticBlocks;
    }

    /**
     * @return bool
     */
    public function isShowInSearch()
    {
        return $this->show_in_search;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @return PageType
     */
    public function getPageType()
    {
        return $this->page_type;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

}
