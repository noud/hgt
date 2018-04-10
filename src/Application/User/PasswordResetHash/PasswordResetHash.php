<?php

namespace HGT\Application\User\PasswordResetHash;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="HGT\AppBundle\Repository\CmsUser\PasswordResetHash\PasswordResetHashRepository")
 * @ORM\Table(name="password_reset_hash")
 */
class PasswordResetHash
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $hash;

    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     */
    private $validUntil;

    /**
     * @param string $username
     * @param string $hash
     * @param DateTimeInterface $validUntil
     */
    public function __construct($username, $hash, DateTimeInterface $validUntil)
    {
        $this->username = $username;
        $this->hash = $hash;
        $this->validUntil = $validUntil;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param DateTimeInterface $at
     * @return bool
     */
    public function isValid(DateTimeInterface $at)
    {
        return $at <= $this->validUntil;
    }

    /**
     * @param DateTimeInterface $validUntil
     */
    public function setValidUntil(DateTimeInterface $validUntil)
    {
        $this->validUntil = $validUntil;
    }
}
