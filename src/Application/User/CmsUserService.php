<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\User\CmsUserRepository;
use HGT\AppBundle\Security\PasswordEncoder;
use HGT\Application\User\User\CmsUser;

class CmsUserService
{
    /**
     * @var CmsUserRepository
     */
    private $userRepository;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * CmsUserService constructor.
     * @param CmsUserRepository $userRepository
     */
    public function __construct(CmsUserRepository $userRepository, PasswordEncoder $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param $id string
     * @return CmsUser
     */
    public function getUserById($id)
    {
        return $this->userRepository->get($id);
    }

    /**
     * @param $email string
     * @return CmsUser
     */
    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    /**
     * @param CmsUser $user
     * @return CmsUser
     */
    public function defineUser(DefineUserCommand $command)
    {
        $user = new CmsUser(
            $command->email,
            $command->name,
            $this->passwordEncoder->encodePassword($command->password)
        );

        $this->userRepository->add($user);

        return $user;
    }

    /**
     * @param CmsUser $user
     * @return CmsUser
     */
    public function reviseUser(ReviseUserCommand $command)
    {
        $user = $this->getUserById($command->id);

        $user->setName($command->name);
        $user->setEmail($command->email);

        return $user;
    }

    /**
     * @param CmsUser $user
     */
    public function removeUser(CmsUser $user)
    {
        $this->userRepository->remove($user);
    }

    /**
     * @param $email string
     * @return bool
     */
    public function emailExists($email)
    {
        return $this->userRepository->emailExists($email);
    }
}
