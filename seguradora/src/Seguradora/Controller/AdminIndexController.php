<?php

namespace Seguradora\Controller;

/**
 * Description of Test
 *
 * @author ricardo
 */
class AdminIndexController extends \Faderim\Framework\Controller\BaseController
{

    public function view()
    {
        $view = new \Faderim\Core\TemplateView('Seguradora\View\Template\admin');
        $view->setParameter('usuario', $this->getSession()->get('usuario'));
        $view->setParameter('menu_itens', Array(
            'apolice' => Array('nome' => 'Apólices', 'router' => 'seg_apolice_list'),
            'tipo_pergunta' => Array('nome' => 'Tipos de Perguntas', 'router' => 'seg_tipo_pergunta_list'),
            'tipo_seguro' => Array('nome' => 'Tipos de Seguro', 'router' => 'seg_tipo_seguro_list'),
            'pergunta' => Array('nome' => 'Perguntas', 'router' => 'seg_pergunta_list'),
            'cliente' => Array('nome' => 'Clientes', 'router' => 'seg_cliente_list'),
            'usuario' => Array('nome' => 'Usuários', 'router' => 'seg_usuario_list')
        ));
        return $view;
    }

}
