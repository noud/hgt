<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FolderPageRepository")
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


    //@TODO: folder_id > folder.id (delete = cascade)


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
