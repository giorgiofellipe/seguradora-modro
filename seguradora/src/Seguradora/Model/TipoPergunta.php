<?php

namespace Seguradora\Model;

/**
 * Description of TipoPergunta
 *
 * @author Giorgio Fellipe
 * @Table(name="tipo_pergunta")
 * @Entity(repositoryClass="Seguradora\Repository\TipoPerguntaRepository")
 */
class TipoPergunta
{

    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="tipper_id")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", length=100, name="tipper_descricao")
     * @var string
     */
    protected $descricao;

    function getId()
    {
        return $this->id;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

}
