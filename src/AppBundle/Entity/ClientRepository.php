<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends \Doctrine\ORM\EntityRepository
{
	public function getDailyClient()
	{
		$now =  new \DateTime('now');

		$date_check1 =  new \DateTime('now');
		$date_check2 =  new \DateTime('now');

		$date_check1->setTime(0,0);
		$date_check2->setTime(1,0);
		

		if ( ($now >= $date_check1) && ($now <= $date_check2) )
	    {
	      	$today = new \DateTime('-1 days');
			$tomorrow = new \DateTime('now');

			$today->setTime(0,0);
			$tomorrow->setTime(0,0);
	    }
	    else
	    {
	      	$today = new \DateTime('now');
			$tomorrow = new \DateTime('tomorrow');

			$today->setTime(0,0);
			$tomorrow->setTime(0,0); 
	    }


		$qb = $this->createQueryBuilder('c')
			->where('c.createdAt >= :today')
			->andWhere('c.createdAt < :tomorrow')
		  	->setParameter('today', $today)
		  	->setParameter('tomorrow', $tomorrow)
		;

		return $qb
			->getQuery()
			->getResult();
	}
}
