<?php

namespace HGT\Application\User\Command;

use Symfony\Component\Validator\Constraints as Assert;

class ChangePasswordCommand
{
    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @var string
     * @Assert\NotBlank
     */
    private $plainPassword;

    /**
     * A non-persisted field that's used to validate the old encoded password.
     *
     * @var string
     * @Assert\NotBlank
     */
    private $oldPassword;

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @param string $oldPassword
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;
    }
}
