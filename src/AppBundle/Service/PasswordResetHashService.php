<?php

namespace AppBundle\Service;

use AppBundle\Entity\PasswordResetHash;
use AppBundle\PasswordResetHash\DateTimeGenerator;
use AppBundle\PasswordResetHash\HashGenerator;
use AppBundle\Repository\PasswordResetHashRepository;
use DateInterval;
use InvalidArgumentException;

class PasswordResetHashService
{
    /**
     * @var HashGenerator
     */
    private $hashGenerator;

    /**
     * @var DateTimeGenerator
     */
    private $dateTimeGenerator;

    /**
     * @var PasswordResetHashRepository
     */
    private $passwordResetHashRepository;

    /**
     * PasswordResetHashService constructor.
     * @param HashGenerator $hashGenerator
     * @param DateTimeGenerator $dateTimeGenerator
     * @param PasswordResetHashRepository $passwordResetHashRepository
     */
    public function __construct(
        HashGenerator $hashGenerator,
        DateTimeGenerator $dateTimeGenerator,
        PasswordResetHashRepository $passwordResetHashRepository
    ) {

        $this->hashGenerator = $hashGenerator;
        $this->dateTimeGenerator = $dateTimeGenerator;
        $this->passwordResetHashRepository = $passwordResetHashRepository;
    }

    /**
     * @param string $username
     * @param string $intervalSpec
     * @return string
     */
    public function generateHash($username, $intervalSpec)
    {
        $hash = $this->hashGenerator->generateHash();

        $now = $this->dateTimeGenerator->now();
        $expirationDate = $now->add(new DateInterval($intervalSpec));

        $passwordResetHash = new PasswordResetHash($username, $hash, $expirationDate);

        $this->passwordResetHashRepository->add($passwordResetHash);
        return $hash;
    }

    /**
     * @param string $hash
     * @return string
     */
    public function get($hash)
    {
        $passwordResetHash = $this->passwordResetHashRepository->findByHash($hash);

        if ($passwordResetHash === null) {
            throw new InvalidArgumentException("Password reset hash not found");
        }

        if (!$passwordResetHash->isValid($this->dateTimeGenerator->now())) {
            throw new InvalidArgumentException("Password reset time has expired");
        }

        return $passwordResetHash->getUsername();
    }

    /**
     * @param string $hash
     * @return bool
     */
    public function validate($hash)
    {
        $passwordResetHash = $this->passwordResetHashRepository->findByHash($hash);

        if ($passwordResetHash === null) {
            return false;
        }

        $now = $this->dateTimeGenerator->now();

        return $passwordResetHash->isValid($now);
    }

    /**
     * @param string $username
     * @return bool
     */
    public function makeAllUserHashesInvalid($username)
    {
        return $this->passwordResetHashRepository->makeAllUserHashesInvalid($username);
    }
}
