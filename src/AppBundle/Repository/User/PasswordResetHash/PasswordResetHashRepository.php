<?php

namespace HGT\AppBundle\Repository\User\PasswordResetHash;

use Doctrine\ORM\EntityRepository;
use HGT\Application\User\PasswordResetHash\PasswordResetHash;

class PasswordResetHashRepository extends EntityRepository
{
    /**
     * @param string $hash
     * @return PasswordResetHash|null|object
     */
    public function findByHash($hash)
    {
        return $this->findOneBy(array('hash' => $hash));
    }

    /**
     * @param PasswordResetHash $passwordResetHash
     */
    public function add(PasswordResetHash $passwordResetHash)
    {
        $this->getEntityManager()->persist($passwordResetHash);
    }

    /**
     * @param string $username
     * @return bool
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function makeAllUserHashesInvalid($username)
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = 'UPDATE `password_reset_hash` SET `valid_until` = NOW() WHERE `username` = :username';

        $stmt = $conn->prepare($sql);

        return $stmt->execute(compact('username'));
    }
}
