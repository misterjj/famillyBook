<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProfileRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function findAllNotAssign()
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.user IS NULL');

        return $qb->getQuery()->execute();
    }
}