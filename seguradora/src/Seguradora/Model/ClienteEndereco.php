<?php

namespace Seguradora\Model;

/**
 * Description of Pergunta
 *
 * @author Rodrigo Cândido
 * @Table(name="cliente_endereco")
 * @Entity(repositoryClass="Seguradora\Repository\ClienteEnderecoRepository")
 */
class ClienteEndereco
{
    
    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="pesend_id")
     * @var int
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="Cliente", inversedBy="clienteEndereco")
     * @JoinColumn(name="pes_id", referencedColumnName="pes_id", nullable=false)
     * @var Cliente
     */
    protected $cliente;
    

    /**
     * @Column(type="string", length=150, name="pesend_bairro", nullable=false)
     * @var string
     */
    protected $bairro;
    
    /**
     * @Column(type="string", length=250, name="pesend_logradouro", nullable=false)
     * @var string
     */
    protected $logradouro;
    
    /**
     * @Column(type="string", length=5, name="pesend_numero", nullable=true)
     * @var string
     */
    protected $numero;
    
    /**
     * @Column(type="string", length=250, name="pesend_complemento", nullable=true)
     * @var string
     */
    protected $complemento;
    
    /**
     * @Column(type="string", length=200, name="pesend_cidade", nullable=false)
     * @var string
     */
    protected $cidade;
    
    /**
     * @Column(type="string", length=2, name="pesend_estado", nullable=false)
     * @var string
     */
    protected $estado;
    
    function getId() {
        return $this->id;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getCidade() {
        return $this->cidade;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCliente(Cliente $cliente) {
        $this->cliente = $cliente;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
        
    public static function getEstadoList(){
        
        return new \Faderim\Util\Enumerator(array(
            "AC"=>"Acre",
            "AL"=>"Alagoas",
            "AM"=>"Amazonas",
            "AP"=>"Amapá",
            "BA"=>"Bahia",
            "CE"=>"Ceará",
            "DF"=>"Distrito Federal",
            "ES"=>"Espírito Santo",
            "GO"=>"Goiás",
            "MA"=>"Maranhão",
            "MT"=>"Mato Grosso",
            "MS"=>"Mato Grosso do Sul",
            "MG"=>"Minas Gerais",
            "PA"=>"Pará",
            "PB"=>"Paraíba",
            "PR"=>"Paraná",
            "PE"=>"Pernambuco",
            "PI"=>"Piauí",
            "RJ"=>"Rio de Janeiro",
            "RN"=>"Rio Grande do Norte",
            "RO"=>"Rondônia",
            "RS"=>"Rio Grande do Sul",
            "RR"=>"Roraima",
            "SC"=>"Santa Catarina",
            "SE"=>"Sergipe",
            "SP"=>"São Paulo",
            "TO"=>"Tocantins")
        );
    }


}