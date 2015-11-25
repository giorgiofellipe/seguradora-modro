<?php

namespace Seguradora\Model;

/**
 * Description of Pergunta
 *
 * @author Giorgio Fellipe
 * @Table(name="pergunta")
 * @Entity(repositoryClass="Seguradora\Repository\PerguntaRepository")
 */
class Pergunta
{

    const FORMA_APLICAR_PORCENTAGEM_ACRESCENTAR = 1;
    const FORMA_APLICAR_PORCENTAGEM_SUBTRAIR = 2;

    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="per_id")
     * @var int
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="TipoPergunta")
     * @JoinColumn(name="tipper_id", referencedColumnName="tipper_id", nullable=false)
     * @var TipoPergunta
     */
    protected $tipoPergunta;

    /**
     * @Column(type="string", length=100, name="per_descricao")
     * @var string
     */
    protected $descricao;

    /**
     * @Column(type="decimal", precision=4, scale=2, name="per_porcentagem")
     * @var float
     */
    protected $porcentagem;

    /**
     * @Column(name="per_forma_aplicar_porcentagem", type="smallint", nullable=false)
     * @var int
     */
    protected $formaAplicarPorcentagem;

    public static function getFormaAplicarPorcentagemLista()
    {
        return new \Faderim\Util\Enumerator(array(
            self::FORMA_APLICAR_PORCENTAGEM_ACRESCENTAR => 'Acrescentar',
            self::FORMA_APLICAR_PORCENTAGEM_SUBTRAIR => 'Subtrair'
        ));
    }

    function getId()
    {
        return $this->id;
    }

    function getTipoPergunta()
    {
        return $this->tipoPergunta;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    function getPorcentagem()
    {
        return $this->porcentagem;
    }

    function getFormaAplicarPorcentagem()
    {
        return $this->formaAplicarPorcentagem;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setTipoPergunta(TipoPergunta $tipoPergunta)
    {
        $this->tipoPergunta = $tipoPergunta;
    }

    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    function setPorcentagem($porcentagem)
    {
        $this->porcentagem = $porcentagem;
    }

    function setFormaAplicarPorcentagem($formaAplicarPorcentagem)
    {
        $this->formaAplicarPorcentagem = $formaAplicarPorcentagem;
    }

}
