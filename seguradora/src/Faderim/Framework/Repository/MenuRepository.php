<?php

namespace Faderim\Framework\Repository;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\ORM\EntityRepository;

/**
 * Description of MenuRepository
 *
 * @author Ricardo Schroeder
 */
class MenuRepository extends EntityRepository
{

    public function getDirectMenuFromSystem(\Faderim\Framework\Model\System $system)
    {
        $qry =
                $this->getEntityManager()->
                createQuery('select m from Faderim\Framework\Model\Menu m
                                       join m.system s
                                       left join m.parent p
                                       where s.id = ?1
                                       and p.id  is null
                                       
                                        ')->
                setMaxResults(10)->
                setParameter(1, $system->getId());
        //echo $qry->getSQL();
        return $qry->getResult();
    }

}

