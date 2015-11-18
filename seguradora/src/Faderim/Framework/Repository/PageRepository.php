<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Framework\Repository;

/**
 * Description of PageRepository
 *
 * @author Rodrigo Cândido
 */
class PageRepository extends BaseEntityRepository
{

    public function getQueryBuilder()
    {
        $query = parent::getQueryBuilder();
        $query->join('Faderim\Framework\Model\Page.system', 'system');
        return $query;
    }

    public function getEnumerator()
    {
        $list = Array();
        foreach ($this->findAll() as /* @var $page \Faderim\Framework\Model\Page */ $page) {
            $list[$page->getName()] = $page->getTitle();
        }
        return new \Faderim\Util\Enumerator($list);
    }

}
