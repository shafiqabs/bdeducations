<?php

namespace Setting\Bundle\ContentBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends EntityRepository
{

    public function findAllOrderedByDate()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT n FROM SettingBundleContent:News n ORDER BY n.startDate DESC'
            )
            ->getResult();
    }



}
