<?php

namespace Seguradora\Model;

/**
 * Description of Apolice (Propostas)
 *
 * @author Rodrigo Cândido
 * @Table(name="apolice")
 * @Entity(repositoryClass="Seguradora\Repository\ApoliceRepository")
 */
class Apolice
{

    const SITUACAO_PENDENTE = 1;
    const SITUACAO_APROVADA = 2;
    const SITUACAO_CANCELADA = 3;
    const SITUACAO_NAO_APROVADA = 4;
    /**
     * Número da Apólice
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="apol_id")
     * @var int
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Cliente")
     * @JoinColumn(name="pes_id", referencedColumnName="pes_id", nullable=false)
     * @var Cliente
     */
    protected $cliente;
    
    /**
     * @ManyToOne(targetEntity="Cliente")
     * @JoinColumn(name="pes_id_prod", referencedColumnName="pes_id", nullable=false)
     * @var Cliente
     */
    protected $proprietario;
    
    /**
     * @ManyToOne(targetEntity="Cliente")
     * @JoinColumn(name="pes_id_cond", referencedColumnName="pes_id", nullable=false)
     * @var Cliente
     */
    protected $condutor;
    
    /**
     * @ManyToOne(targetEntity="TipoSeguro")
     * @JoinColumn(name="tipseg_id", referencedColumnName="tipseg_id", nullable=false)
     * @var TipoSeguro
     */
    protected $tipoSeguro;
    
    /**
     * @ManyToOne(targetEntity="TipoSeguroRegiao")
     * @JoinColumn(name="tipreg_id", referencedColumnName="tipreg_id", nullable=true)
     * @var TipoSeguroRegiao
     */
    protected $tipoSeguroRegiao;

    /**
     * @Column(type="text", name="apol_descricao_bem",nullable=false)
     * @var string
     */
    protected $descricaoBem;
    
    
    /**
     * @Column(type="string", length=20, name="apol_placa",nullable=true)
     * @var string
     */
    protected $placa;
    
    /**
     * @Column(type="integer",  name="apol_ano_modelo",nullable=true)
     * @var int
     */
    protected $anoModelo;
    
    /**
     * @Column(type="integer",  name="apol_ano_fabricacao",nullable=true)
     * @var int
     */
    protected $anoFabricacao;
    
    /**
     * @Column(type="string", length=200,  name="apol_fabricante",nullable=true)
     * @var string
     */
    protected $fabricante;
    
    /**
     * @Column(type="decimal",precision=10, scale=2, name="apol_valor_bem",nullable=false)
     * @var float
     */
    protected $valorBem;
    
    /**
     * @Column(type="date", name="apol_data_inicio",nullable=false)
     * @var \Date
     */
    protected $dataInicio;
    /**
     * @Column(type="date", name="apol_data_fim",nullable=false)
     * @var \Date
     */
    protected $dataFim;
    
    /**
     * @Column(type="integer", name="apol_situacao",nullable=false)
     * @var int
     */
    protected $situacao;

    /**
     * @Column(type="integer", name="apol_bonus",nullable=true)
     * @var float
     */
    protected $bonus;

    /**
     * @OneToMany(targetEntity="ApolicePergunta", mappedBy="apolice", cascade={"persist", "remove", "refresh"})
     * @var ApolicePergunta[]|\Doctrine\Common\Collections\ArrayCollection
     */    
    protected $apolicePerguntas;
    
    public function __construct() {
        $this->apolicePerguntas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function getId() {
        return $this->id;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getProprietario() {
        return $this->proprietario;
    }

    function getCondutor() {
        return $this->condutor;
    }

    function getTipoSeguro() {
        return $this->tipoSeguro;
    }

    function getTipoSeguroRegiao() {
        return $this->tipoSeguroRegiao;
    }

    function getDescricaoBem() {
        return $this->descricaoBem;
    }

    function getValorBem() {
        return $this->valorBem;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataFim() {
        return $this->dataFim;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function getBonus() {
        return $this->bonus;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCliente(Cliente $cliente) {
        $this->cliente = $cliente;
    }

    function setProprietario(Cliente $proprietario) {
        $this->proprietario = $proprietario;
    }

    function setCondutor(Cliente $condutor) {
        $this->condutor = $condutor;
    }

    function setTipoSeguro(TipoSeguro $tipoSeguro) {
        $this->tipoSeguro = $tipoSeguro;
    }

    function setTipoSeguroRegiao(TipoSeguroRegiao $tipoSeguroRegiao = null) {
        $this->tipoSeguroRegiao = $tipoSeguroRegiao;
    }

    function setDescricaoBem($descricaoBem) {
        $this->descricaoBem = $descricaoBem;
    }

    function setValorBem($valorBem) {
        $this->valorBem = $valorBem;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function setBonus($bonus) {
        $this->bonus = $bonus;
    }
    
    function getPlaca() {
        return $this->placa;
    }

    function getAnoModelo() {
        return $this->anoModelo;
    }

    function getAnoFabricacao() {
        return $this->anoFabricacao;
    }

    function getFabricante() {
        return $this->fabricante;
    }

    function setPlaca($placa) {
        $this->placa = $placa;
    }

    function setAnoModelo($anoModelo) {
        $this->anoModelo = $anoModelo;
    }

    function setAnoFabricacao($anoFabricacao) {
        $this->anoFabricacao = $anoFabricacao;
    }

    function setFabricante($fabricante) {
        $this->fabricante = $fabricante;
    }

    
    
    public static function getBonusList()
    {
        return new \Faderim\Util\Enumerator(array(
            1=> '01',
            2=> '02',
            3=> '03',
            4=> '04',
            5=> '05',
            6=> '06',
            7=> '07',
            8=> '08',
            9=> '09',
            10=> '10'
        ));
    }
    public static function getSituacaoList()
    {
        return new \Faderim\Util\Enumerator(array(
            self::SITUACAO_PENDENTE => 'Pendente',
            self::SITUACAO_APROVADA => 'Aprovada',
            self::SITUACAO_CANCELADA => 'Cancelada',
            self::SITUACAO_NAO_APROVADA=> 'Não Aprovada'
        ));
    }

    
    public function newApolicePergunta() {
        $apolicePergunta = new ApolicePergunta();
        $apolicePergunta->setApolice($this);
        $this->apolicePerguntas->add($apolicePergunta);
        return $apolicePergunta;
    }
    

}
