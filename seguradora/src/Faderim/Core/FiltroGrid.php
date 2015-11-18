<?php

namespace Faderim\Core;

/**
 * Description of FiltroGrid
 *
 * @author Rodrigo Cândido <rodrigo@magamobi.com.br>
 */
class FiltroGrid implements \Faderim\Json\JsonSerializable
{

    protected $nome;
    protected $operador;
    protected $valor;

    public function __construct($nome = null, $operador = null, $valor = null)
    {
        $this->setNome($nome);
        $this->setOperador($operador);
        $this->setValor($valor);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getOperador()
    {
        return $this->operador;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setOperador($operador)
    {
        $this->operador = $operador;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getJsonFormat()
    {
        return Array('id' => $this->getNome(), 'property' => $this->getOperador(), 'value' => $this->getValor());
    }

}
