<?php

namespace Seguradora\Model;

/**
 * Description of Usuario
 *
 * @author Rodrigo Cândido <rodrigocandido.bsi@gmail.com.br>
 * @Table(name="usuario")
 * @Entity(repositoryClass="Seguradora\Repository\UsuarioRepository")
 */
class Usuario {

    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="usu_id")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", length=150, name="usu_nome")
     * @var string
     */
    protected $nome;

    /**
     * @Column(type="string", length=50, name="usu_senha")
     * @var string
     */
    protected $senha;

    /**
     * @Column(type="string", length=100, name="usu_login",unique=true)
     * @var string
     */
    protected $login;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setSenha($senha) {
        $this->senha = sha1($senha);
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function validaSenha($senha) {        
        return sha1($senha) === $this->senha;
    }

}
