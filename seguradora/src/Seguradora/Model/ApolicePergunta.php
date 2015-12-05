<?php

namespace Seguradora\Model;

/**
 * Description of ApolicePergunta
 *
 * @author giorgiofellipe
 * @Table(name="apolice_pergunta",uniqueConstraints={@UniqueConstraint(name="uq_apolice_pergunta", columns={"apol_id", "per_id"})})
 * @Entity(repositoryClass="Seguradora\Repository\ApolicePerguntaRepository")
 */
class ApolicePergunta {
    
    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="apoper_id")
     * @var int
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="Apolice", inversedBy="apolicePerguntas")
     * @JoinColumn(name="apol_id", referencedColumnName="apol_id", nullable=false)
     * @var Apolice
     */
    protected $apolice;
    
    /**
     * @ManyToOne(targetEntity="Pergunta")
     * @JoinColumn(name="per_id", referencedColumnName="per_id", nullable=false)
     * @var Pergunta
     */
    protected $pergunta;
    
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
    
    /**
     * @Column(name="apoper_resposta", type="boolean", nullable=true)
     * @var boolean
     */
    protected $resposta;
    
    public function getId() {
        return $this->id;
    }

    public function getApolice() {
        return $this->apolice;
    }

    public function getPergunta() {
        return $this->pergunta;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getPorcentagem() {
        return $this->porcentagem;
    }

    public function getFormaAplicarPorcentagem() {
        return $this->formaAplicarPorcentagem;
    }

    public function getResposta() {
        return $this->resposta;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setApolice(Apolice $apolice) {
        $this->apolice = $apolice;
    }

    public function setPergunta(Pergunta $pergunta) {
        $this->pergunta = $pergunta;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setPorcentagem($porcentagem) {
        $this->porcentagem = $porcentagem;
    }

    public function setFormaAplicarPorcentagem($formaAplicarPorcentagem) {
        $this->formaAplicarPorcentagem = $formaAplicarPorcentagem;
    }

    public function setResposta($reposta) {
        $this->resposta = $reposta;
    }
    
    public function getTipoPergunta() {
        return $this->tipoPergunta;
    }

    public function setTipoPergunta(TipoPergunta $tipoPergunta) {
        $this->tipoPergunta = $tipoPergunta;
    }

}
