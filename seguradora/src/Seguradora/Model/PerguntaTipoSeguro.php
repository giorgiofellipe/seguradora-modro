<?php

namespace Seguradora\Model;

/**
 * Description of TipoSeguroRegiao
 *
 * @author Rodrigo Cândido
 * @Table(name="pergunta_tipo_seguro")
 * @Entity(repositoryClass="Seguradora\Repository\PerguntaTipoSeguroRepository")
 */
class PerguntaTipoSeguro
{

    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="perseg_id")
     * @var int
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="Pergunta", inversedBy="perguntaTipoSeguro")
     * @JoinColumn(name="per_id", referencedColumnName="per_id", nullable=false)
     * @var Pergunta
     */
    protected $pergunta;
    
    /**
     * @ManyToOne(targetEntity="TipoSeguro")
     * @JoinColumn(name="tipseg_id", referencedColumnName="tipseg_id", nullable=false)
     * @var TipoSeguro
     */
    protected $tipoSeguro;
    
    function getId() {
        return $this->id;
    }

    function getPergunta() {
        return $this->pergunta;
    }

    function getTipoSeguro() {
        return $this->tipoSeguro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPergunta(Pergunta $pergunta = null) {
        $this->pergunta = $pergunta;
    }

    function setTipoSeguro(TipoSeguro $tipoSeguro = null) {
        $this->tipoSeguro = $tipoSeguro;
    }


    
    

}
