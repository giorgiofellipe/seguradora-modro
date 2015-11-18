<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Seguradora\Controller;

/**
 * Description of AdminFrontController
 *
 * @author Rodrigo Cândido <rodrigocandido.bsi@gmail.com.br>
 */
class AdminFrontController extends \Faderim\Framework\Controller\DatabaseFrontController {

    protected function hasAccess() {
        if ($this->router->getPage()->getName() == 'seguradora_login') {
            return true;
        } else
        if ($this->getSession()->has('usuario') and $this->getSession()->get('usuario')) {
            return true;
        }
        return false;
    }

    protected function noAccessRender() {
        header('location:/login');
    }

}
