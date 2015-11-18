<?php

namespace Faderim\Framework\Controller;

use Faderim\Framework\View\Template;
use Faderim\Framework\Model\System;

/**
 * Description of IndexController
 *
 * @author Ricardo Schroeder
 */
class IndexController extends BaseController
{

    public function indexAction()
    {
        if (!$this->getRequest()->isAjax()) {
            $View = new Template\IndexTemplate();
            $em = $this->getEntityManager();
            $systemRepository = $em->getRepository('Faderim\Framework\Model\System');

            $menuRepository = $em->getRepository('Faderim\Framework\Model\Menu');
            $systems = $systemRepository->findByEnable(true);
            foreach ($systems as $system) {
                $menus = $menuRepository->getDirectMenuFromSystem($system);
                $system->setMenus($menus);
            }
            $View->setSystems($systems);
            return $View;
        }
    }

}

