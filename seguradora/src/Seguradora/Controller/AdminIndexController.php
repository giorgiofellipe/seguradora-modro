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
            //'pedido' => Array('nome' => 'Gerenciar Projetos', 'router' => 'oc_ger_projeto_list'),
            //'dashboard' => Array('nome' => 'Composições SINAPI', 'router' => 'oc_composicao_sinapi_list'),
            //'config' => Array('nome' => 'Log de Importações', 'router' => 'oc_log_importacao_list'),
            'cliente' => Array('nome' => 'Usuários', 'router' => 'seg_usuario_list'),
            'tipo_pergunta' => Array('nome' => 'Tipos de Perguntas', 'router' => 'seg_tipo_pergunta_list'),
            'tipo_seguro' => Array('nome' => 'Tipos de Seguro', 'router' => 'seg_tipo_seguro_list'),
            'pergunta' => Array('nome' => 'Perguntas', 'router' => 'seg_pergunta_list'),
                /* 'adm' => Array('nome' => 'Administração', 'childs' => Array(
                  'system' => Array('nome' => 'Sistema', 'router' => 'fd_system_list'),
                  'page' => Array('nome' => 'Páginas', 'router' => 'fd_page_list'),
                  'router' => Array('nome' => 'Rotas', 'router' => 'fd_router_list'),
                  'usuario' => Array('nome' => 'Usuários', 'router' => 'mz_usuario_list'),
                  'perfil' => Array('nome' => 'Perfil', 'router' => 'mz_perfil_list'))) */
        ));
        return $view;
    }

}
