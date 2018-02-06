<?php

namespace AppBundle\Service;

use AppBundle\Command\DefineUserCommand;
use AppBundle\Command\ReviseUserCommand;
use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use AppBundle\Security\PasswordEncoder;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, PasswordEncoder $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param $id string
     * @return User
     */
    public function getUserById($id)
    {
        return $this->userRepository->get($id);
    }

    /**
     * @param $email string
     * @return User
     */
    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    /**
     * @param User $user
     * @return User
     */
    public function defineUser(DefineUserCommand $command)
    {
        $user = new User(
            $command->email,
            $command->name,
            $this->passwordEncoder->encodePassword($command->password)
        );

        $this->userRepository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function reviseUser(ReviseUserCommand $command)
    {
        $user = $this->getUserById($command->id);

        $user->setName($command->name);
        $user->setEmail($command->email);

        return $user;
    }

    /**
     * @param User $user
     */
    public function removeUser(User $user)
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
