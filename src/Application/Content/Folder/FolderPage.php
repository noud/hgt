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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param mixed $folder
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    /**
     * @return string
     */
    public function getFolderImage()
    {
        return $this->folder_image;
    }

    /**
     * @param string $folder_image
     */
    public function setFolderImage($folder_image)
    {
        $this->folder_image = $folder_image;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }









}
