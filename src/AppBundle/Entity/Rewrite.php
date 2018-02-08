<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RewriteRepository")
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


    //@TODO: page_id > page.id


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $canonical_url;
}
