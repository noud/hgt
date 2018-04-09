<?php

namespace HGT\Application\Content\Home;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\Content\Home\HomeBannerRepository")
 * @ORM\Table(name="home_banner")
 */
class HomeBanner
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
    private $banner_image;

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
    public function getBannerImage()
    {
        return $this->banner_image;
    }

    /**
     * @param string $banner_image
     */
    public function setBannerImage($banner_image)
    {
        $this->banner_image = $banner_image;
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
     * @return mixed
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

}
