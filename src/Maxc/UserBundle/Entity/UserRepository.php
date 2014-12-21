<?php

namespace Maxc\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    public function getForInfoAdmin(){
        return $this->createQueryBuilder('t')
            ->select('count(t)')
            ->getQuery()->getSingleScalarResult();
    }

    public function getActive4InfoAdmin(){
        return $this->createQueryBuilder('t')
            ->select('count(t)')
            ->where('t.lastLogin >= :last_login')
            ->setParameter('last_login', new \DateTime('yesterday'))
            ->getQuery()->getSingleScalarResult();
    }

    public function getByDt($from = null, $to = null, $byhour = null){
        $substr = $byhour ? 13 : 10;
        $qb = $this->createQueryBuilder('t')
            ->select("SUBSTRING(t.createdAt, 1, $substr) oy, COUNT(t.id) cnt")
            ->where('t.enabled = 1 and t.createdAt >= :from')
            ->setParameter('from', $from ? $from : new \DateTime('first day of this month'))
            ->groupBy("oy");
        if($to) $qb->andWhere('t.createdAt <= :to')->setParameter('to', $to);
        return $qb->getQuery()->getResult();
    }

}
