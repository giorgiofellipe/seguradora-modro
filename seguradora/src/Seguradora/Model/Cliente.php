<?php

namespace Seguradora\Model;

/**
 * Description of Pergunta
 *
 * @author Rodrigo Cândido
 * @Table(name="cliente")
 * @Entity(repositoryClass="Seguradora\Repository\ClienteRepository")
 */
class Cliente
{
    
    /**
     * @GeneratedValue(strategy="AUTO")
     * @Id
     * @Column(type="smallint",name="pes_id")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", length=250, name="pes_nome", nullable=false)
     * @var string
     */
    protected $nome;
    
    /**
     * @Column(type="string", length=20, name="pes_cpf", nullable=true)
     * @var string
     */
    protected $cpf;
    
    /**
     * @Column(type="string", length=250, name="pes_email", nullable=true)
     * @var string
     */
    protected $email;
    
    /**
     * @Column(type="string", length=20, name="pes_telefone", nullable=true)
     * @var string
     */
    protected $telefone;
    
    /**
     * @Column(type="string", length=15, name="pes_rg", nullable=true)
     * @var string
     */
    protected $rg;
    
    /**
     * @Column(type="date", name="pes_data_cnh",nullable=true)
     * @var \DateTime
     */
    protected $dataCnh;
    
    /**
     * @Column(type="date", name="pes_data_nasc",nullable=true)
     * @var \DateTime
     */
    protected $dataNascimento;
    
    /**
     * @OneToMany(targetEntity="ClienteEndereco", mappedBy="cliente",cascade={"persist", "remove", "refresh"})
     * @var ClienteEndereco[]|\Doctrine\Common\Collections\ArrayCollection
     */    
    protected $clienteEndereco;
    
    public function __construct() {
        $this->clienteEndereco = new \Doctrine\Common\Collections\ArrayCollection();
    }
            
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getRg() {
        return $this->rg;
    }

    function getDataCnh() {
        return $this->dataCnh;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setDataCnh(\DateTime $dataCnh = null) {
        $this->dataCnh = $dataCnh;
    }

    function setDataNascimento(\DateTime $dataNascimento = null) {
        $this->dataNascimento = $dataNascimento;
    }
    
    function getClienteEndereco() {
        return $this->clienteEndereco;
    }

    function setClienteEndereco($clienteEndereco) {
        $this->clienteEndereco = $clienteEndereco;
    }
        
    public function newClienteEndereco(){
        $clienteEndereco = new ClienteEndereco();
        $clienteEndereco->setCliente($this);
        $this->getClienteEndereco()->add($clienteEndereco);
        return $clienteEndereco;
    }


    
    

}
