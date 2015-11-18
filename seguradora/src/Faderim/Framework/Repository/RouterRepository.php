<?php

namespace Faderim\Framework\Repository;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\ORM\EntityRepository;

/**
 * Description of RouterRepository
 *
 * @author Ricardo Schroeder
 */
class RouterRepository extends BaseEntityRepository
{

    public function findByPath($path)
    {
        $routers = $this->_em->createQuery("SELECT r FROM Faderim\Framework\Model\Router r WHERE r.path is not null")->getResult();
        foreach ($routers as $router) {
            if ($router->match($path)) {
                return $router;
            }
        }
        return null;
    }

    public function getQueryBuilder()
    {
        $query = parent::getQueryBuilder();
        $query->join('Faderim\Framework\Model\Router.page', 'page');
        return $query;
    }

}
