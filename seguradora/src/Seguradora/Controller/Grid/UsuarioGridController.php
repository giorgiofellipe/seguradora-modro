<?php

namespace Seguradora\Controller\Grid;

/**
 * Description of MarcaList
 *
 * @author Ricardo Schroeder <ricardo@magamobi.com.br>
 */
class UsuarioGridController extends \Faderim\Framework\Controller\BaseListController {

    protected function createInstanceView() {
        return new \Seguradora\View\Grid\UsuarioGrid();
    }

    protected function createInstanceRepository() {
        return $this->getEntityManager()->getRepository('Seguradora\Model\Usuario');
    }

}
