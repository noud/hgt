<?php

namespace HGT\Application\Content\Folder;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Content\Folder\FolderPageRepository")
 * @ORM\Table(name="folder_page")
 */
class FolderPage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\Content\Folder\Folder", inversedBy="folder_page")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $folder;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $folder_image;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":900})
     */
    private $priority;
}
