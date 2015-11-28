<?php

namespace Seguradora\Model;

/**
 * Description of TipoSeguroRegiao
 *
 * @author Rodrigo Cândido
 * @Table(name="tipo_seguro_regiao")
 * @Entity(repositoryClass="Seguradora\Repository\TipoSeguroRegiaoRepository")
 */
class TipoSeguroRegiao
{

    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="tipreg_id")
     * @var int
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="TipoSeguro", inversedBy="tipoSeguroRegiao")
     * @JoinColumn(name="tipseg_id", referencedColumnName="tipseg_id", nullable=false)
     * @var TipoSeguro
     */
    protected $tipoSeguro;

    /**
     * @Column(type="string", length=150, name="tipreg_regiao")
     * @var string
     */
    protected $regiao;

    /**
     * @Column(type="decimal", precision=4, scale=2, name="tipseg_porcentagem",nullable=false)
     * @var float
     */
    protected $porcentagem;

    function getId() {
        return $this->id;
    }

    function getTipoSeguro() {
        return $this->tipoSeguro;
    }

    function getRegiao() {
        return $this->regiao;
    }

    function getPorcentagem() {
        return $this->porcentagem;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipoSeguro(TipoSeguro $tipoSeguro) {
        $this->tipoSeguro = $tipoSeguro;
    }

    function setRegiao($regiao) {
        $this->regiao = $regiao;
    }

    function setPorcentagem($porcentagem) {
        $this->porcentagem = $porcentagem;
    }
    
    public function getDescricaoList(){
        return $this->getRegiao() . ' ('.$this->getPorcentagem() . '%)';
    }



}
