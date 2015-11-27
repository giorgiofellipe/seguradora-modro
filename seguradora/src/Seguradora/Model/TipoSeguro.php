<?php

namespace Seguradora\Model;

/**
 * Description of TipoSeguro
 *
 * @author Giorgio Fellipe
 * @Table(name="tipo_seguro")
 * @Entity(repositoryClass="Seguradora\Repository\TipoSeguroRepository")
 */
class TipoSeguro
{

    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="tipseg_id")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", length=150, name="tipseg_descricao")
     * @var string
     */
    protected $descricao;

    /**
     * @Column(type="decimal", precision=4, scale=2, name="tipseg_porcentagem_franquia")
     * @var float
     */
    protected $porcentagemFranquia;
    
    /**
     * @OneToMany(targetEntity="TipoSeguroRegiao", mappedBy="tipoSeguro",cascade={"persist", "remove", "refresh"})
     * @var TipoSeguroRegiao[]|\Doctrine\Common\Collections\ArrayCollection
     */    
    protected $tipoSeguroRegiao;
    
    public function __construct() {
        $this->tipoSeguroRegiao = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getId()
    {
        return $this->id;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    function getPorcentagemFranquia()
    {
        return $this->porcentagemFranquia;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    function setPorcentagemFranquia($porcentagemFranquia)
    {
        $this->porcentagemFranquia = $porcentagemFranquia;
    }
    
    function getTipoSeguroRegiao() {
        return $this->tipoSeguroRegiao;
    }

    function setTipoSeguroRegiao($tipoSeguroRegiao) {
        $this->tipoSeguroRegiao = $tipoSeguroRegiao;
    }
    
    public function newTipoSeguroRegiao(){
        $new = new TipoSeguroRegiao();
        $new->setTipoSeguro($this);
        $this->getTipoSeguroRegiao()->add($new);
        return $new;
    }



}
