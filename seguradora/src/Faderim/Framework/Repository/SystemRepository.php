<?php

namespace Faderim\Framework\Repository;

/**
 * Description of PageRepository
 *
 * @author Rodrigo Cândido
 */
class SystemRepository extends BaseEntityRepository
{

    public function getEnumerator()
    {
        $list = Array();
        foreach ($this->findAll() as /* @var $system \Faderim\Framework\Model\System */ $system) {
            $list[$system->getId()] = $system->getName();
        }
        return new \Faderim\Util\Enumerator($list);
    }

}
