<?php

namespace HGT\AppBundle\Repository\Catalog\Order;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Order\InvalidDeliveryDate;

class InvalidDeliveryDateRepository extends ServiceEntityRepository
{
    /**
     * InvalidDeliveryDateRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvalidDeliveryDate::class);
    }

    /**
     * @param $id
     * @return InvalidDeliveryDate|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param InvalidDeliveryDate $invalidDeliveryDate
     */
    public function add(InvalidDeliveryDate $invalidDeliveryDate)
    {
        $this->getEntityManager()->persist($invalidDeliveryDate);
    }

    /**
     * @param InvalidDeliveryDate $invalidDeliveryDate
     */
    public function remove(InvalidDeliveryDate $invalidDeliveryDate)
    {
        $this->getEntityManager()->remove($invalidDeliveryDate);
    }

    /**
     * @param \DateTime $date
     * @return InvalidDeliveryDate|null|object
     */
    public function getInvalidDeliveryDateByDate(\DateTime $date)
    {
        return $this->findOneBy([
            'invalid_delivery_date' => $date
        ]);
    }

    /**
     * @param null $tillDateMysql
     * @return array
     */
    public function getInvalidDeliveryDates($tillDateMysql = null)
    {
        $lastMonday = date('Y-m-d', strtotime('last Monday'));

        $qb = $this->createQueryBuilder('q');
        $qb->where('q.invalid_delivery_date >= :last_monday');

        if ($tillDateMysql !== null) {
            $qb->where('q.invalid_delivery_date <= :till_delivery_date');
            $qb->setParameter('till_delivery_date', $tillDateMysql);
        }

        $qb->setParameter('last_monday', $lastMonday);
        $qb->orderBy('q.invalid_delivery_date');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $tillDateMysql
     * @return array
     */
    public function getInvalidDeliveryDatesAsDateArray($tillDateMysql = null)
    {
        $dates = array();

        /** @var InvalidDeliveryDate $invalidDeliveryDate */
        foreach ($this->getInvalidDeliveryDates($tillDateMysql) as $invalidDeliveryDate) {
            $dates[] = $invalidDeliveryDate->getInvalidDeliveryDate()->format('Y-m-d');
        }

        return $dates;
    }

    /**
     * @return array
     */
    public function getValidDeliveryDatesAsDateArray($tillDateMysql = null)
    {
        $dates = array();

        foreach ($this->getInvalidDeliveryDatesAsDateArray() as $invalidDeliveryDate) {
            $today = date("N", strtotime($invalidDeliveryDate));

            //add dates before today till monday this week;
            for ($day = ($today - 1); $day >= 1; $day--) {
                $dates[] = date("Y-m-d", strtotime($invalidDeliveryDate . ' - ' . $day . ' days'));
            }

            //add dates after today till saturday this week;
            for ($day = ($today + 1); $day <= 6; $day++) {
                $dates[] = date("Y-m-d", strtotime($invalidDeliveryDate . ' + ' . ($day - $today) . ' days'));
            }
        }

        return $dates;
    }
}
