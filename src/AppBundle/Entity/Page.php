<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
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


    //@TODO: parent_id > parent.id


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


    //@TODO; page_type_id > page_type.id


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
