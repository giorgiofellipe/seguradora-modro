<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Framework\Controller;

/**
 * Description of RouterFormController
 *
 * @author Rodrigo
 */
class RouterFormController extends \Faderim\Framework\Controller\BaseFormController
{

    protected function createInstanceModel()
    {
        return new \Faderim\Framework\Model\Router();
    }

    protected function createInstanceView()
    {
        return new \Faderim\Framework\View\Form\RouterForm();
    }

}
