<?php

namespace Faderim\Framework\Controller;

/**
 * Description of SystemFormController
 *
 * @author Rodrigo
 */
class SystemFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Faderim\Framework\Model\System();
    }

    protected function createInstanceView()
    {
        return new \Faderim\Framework\View\Form\SystemForm();
    }

}
