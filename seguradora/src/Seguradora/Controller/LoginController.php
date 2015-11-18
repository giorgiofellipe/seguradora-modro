<?php

namespace Seguradora\Controller;

/**
 * Classe responsável por realizar um login no usuario
 *
 * @author Rodrigo Cândido <rodrigocandido.bsi@gmail.com.br>
 */
class LoginController extends \Faderim\Framework\Controller\BaseController {

    public function logout() {
        $this->getSession()->destroy();
        header('location:/login');
    }

    public function view() {
        $view = new \Faderim\Core\TemplateView('Seguradora\View\Template\login');
        if ($this->getRequest()->isPost()) {
            $email = $this->getRequest()->getParameter('email');
            $senha = $this->getRequest()->getParameter('password');
            $usuario = $this->getEntityManager()->getRepository('Seguradora\Model\Usuario')->getUsuarioByEmail($email);
            if ($usuario === null or ! $usuario->validaSenha($senha)) {
                $view->setParameter('erro', 'Usuário ou senha informados inválidos!');
            } else {
                $this->getSession()->set('usuario', $usuario);
                header('location:/');
                return;
            }
        }
        return $view;
    }

}
