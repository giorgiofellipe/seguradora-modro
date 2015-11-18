<?php

namespace Seguradora\Repository;

use Faderim\Framework\Repository\BaseEntityRepository;

/**
 * @author Rodrigo Cândido <rodrigocandido.bsi@gmail.com.br>
 */
class UsuarioRepository extends BaseEntityRepository {

    public function getUsuarioByEmail($email) {


        return $this->_em->createQuery('select usuario
                                          from Seguradora\Model\Usuario usuario
                                         where lower(usuario.login) = :email'
                )->setParameter('email', $email)->getOneOrNullResult();
    }

}
