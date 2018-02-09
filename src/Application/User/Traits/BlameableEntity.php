<?php

namespace HGT\Application\User\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use HGT\Application\User\User\User;

trait BlameableEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\User\User")
     * @Gedmo\Blameable(on="create")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="HGT\Application\User\User\User")
     * @Gedmo\Blameable(on="update")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $updatedBy;

    /**
     * Sets createdBy.
     *
     * @param User $createdBy
     * @return $this
     */
    public function setCreatedBy(User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Returns createdBy.
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Sets updatedBy.
     *
     * @param  User $updatedBy
     * @return $this
     */
    public function setUpdatedBy(User $updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Returns updatedBy.
     *
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
}
