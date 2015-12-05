<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Seguradora\View\Report;

/**
 * Description of GerencialLayoutReport
 *
 * @author Rodrigo
 */
abstract class BaseLayoutReport {
    
    protected $models = null;
    protected $titulo = 'Relatório';
    protected $filtros = null;
    /**
     * Modelo Atual
     * @var type 
     */
    protected $model = null;


    public function __construct($models = null) {
        $this->setModels($models);       
    }
    
    
    public function imprimir(){
        ?>
        <html>
            <head><title>Report</title></head>
            <style>
                .body{
                    font-family: Arial;
                    text-align: center;
                }
                .table{
                    width: 90%;
                    
                }
                .table td {
                    border-bottom: 1px solid black;
                    border-right: 1px solid black;
                }
                .titulo{
                    font-weight: bold;
                }
            </style>
            <body class="body">
        <?php
        $this->renderCabecalho();
        $this->processa();
        $this->renderRodape();
        ?>
            </body>
        </html>
        <?php
    }
    
    abstract function render();
    
    protected function processa(){        
        foreach($this->models as $model){
            $this->setModel($model);
            $this->render();
        }        
    }

    protected function renderCabecalho(){
        echo '<h1>'.$this->getTitulo().'</h1>';
        if($this->getFiltros() !== null){
            echo '<h5>Filtros: '.$this->getFiltros().'</h5>';
        }
    }
    
    protected function renderRodape(){
        $date = new \DateTime();
        $texto = $date->format(\Faderim\Date\DateTime::FORMAT_DATETIME);
        $texto .= ' Usuário: ' . \Faderim\Core\FaderimEngine::getInstance()->getSession()->get('usuario')->getNome();
        echo  '<div style="text-align:center;font-size:14px;">Emitido em: ' . $texto . '</div>';
    }
            
    function getModels() {
        return $this->models;
    }

    function setModels($models) {
        $this->models = $models;
    }
    
    function getModel() {
        return $this->model;
    }

    function setModel($model) {
        $this->model = $model;
    }
    
    function getTitulo() {
        return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
    function getFiltros() {
        return $this->filtros;
    }

    function setFiltros($filtros) {
        $this->filtros = $filtros;
    }
}
