<?php

namespace App\Repository;

/**
 * ActiviteitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActiviteitRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBeschikbareActiviteiten($userid)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT a FROM App:Activiteit a WHERE :userid NOT MEMBER OF a.users ORDER BY a.datum");

        $query->setParameter('userid',$userid);

        return $query->getResult();
    }

    public function getIngeschrevenActiviteiten($userid)
    {

        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT a FROM App:Activiteit a WHERE :userid MEMBER OF a.users ORDER BY a.datum");

        $query->setParameter('userid',$userid);

        return $query->getResult();
    }

    public function getTotaal($activiteiten)
    {

        $totaal=0;
        foreach($activiteiten as $a)
        {
            $totaal+=$a->getSoort()->getPrijs();
        }
        return $totaal;

    }
    public function findAll()
    {
        return $this->findBy(array(),array('datum'=>'ASC'));
    }
}
