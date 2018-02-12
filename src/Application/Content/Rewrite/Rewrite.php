<?php

namespace HGT\Application\Content\Rewrite;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Content\Rewrite\RewriteRepository")
 * @ORM\Table(name="rewrite")
 */
class Rewrite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $is_system;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $id_path;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $request_path;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $target_path;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\Page\Page", inversedBy="rewrite")
     */
    private $page;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $canonical_url;
}
