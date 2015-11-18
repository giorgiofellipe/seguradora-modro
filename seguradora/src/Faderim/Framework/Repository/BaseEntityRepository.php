<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Framework\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of BaseEntityRepository
 *
 * @author Rodrigo Cândido
 */
class BaseEntityRepository extends EntityRepository {

    public function getQueryBuilder() {
        return $this->createQueryBuilder($this->_entityName);
    }
}
