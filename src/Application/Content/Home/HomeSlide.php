<?php

namespace HGT\Application\Content\Home;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Content\Home\HomeSlideRepository")
 * @ORM\Table(name="home_slide")
 */
class HomeSlide
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
     * @ORM\Column(type="string")
     */
    private $slide_image;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default":900})
     */
    private $priority;

    /**
     * @var DateTime
     * @ORM\Column(type="date")
     */
    private $date_from;

    /**
     * @var DateTime
     * @ORM\Column(type="date", nullable=true, options={"default":NULL})
     */
    private $date_to;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlideImage()
    {
        return $this->slide_image;
    }

    /**
     * @param string $slide_image
     */
    public function setSlideImage($slide_image)
    {
        $this->slide_image = $slide_image;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return DateTime
     */
    public function getDateFrom()
    {
        return $this->date_from;
    }

    /**
     * @return DateTime
     */
    public function getDateTo()
    {
        return $this->date_to;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @param DateTime $date_from
     */
    public function setDateFrom($date_from)
    {
        $this->date_from = $date_from;
    }

    /**
     * @param DateTime $date_to
     */
    public function setDateTo($date_to)
    {
        $this->date_to = $date_to;
    }

}
