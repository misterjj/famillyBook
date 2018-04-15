<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 15/04/2018
 * Time: 10:28
 */

namespace UserBundle\Service;


use FOS\UserBundle\Doctrine\UserManager;
use FOS\UserBundle\Model\UserManagerInterface;

class UsersManager extends UserManager implements UserManagerInterface
{

    public function FindLastUser(int $limit, int $page): array
    {
        if ($page < 1 || $limit < 1) {
            return [];
        }
        $users = $this->getRepository()->findBy(
            [],
            ['id' => 'desc'],
            $limit,
            ($page - 1) * $limit
        );

        return $users;
    }

    public function getUserCount(): int
    {
        return count($this->getRepository()->findAll());
    }
}