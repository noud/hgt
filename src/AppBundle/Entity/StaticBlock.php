<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StaticBlockRepository")
 * @ORM\Table(name="static_block")
 */
class StaticBlock
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
    private $identifier;

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
     * @ORM\Column(type="string", options={"comment":"internal use only"})
     */
    private $name;
}
