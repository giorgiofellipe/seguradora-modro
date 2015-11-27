<?php

namespace Seguradora\View\Form;

use Faderim\Ext\Field as Field;
use Faderim\Ext\Field\TypeField;

/**
 * Description of ClienteForm
 *
 * @author Rodrigo Cândido
 */
class ClienteForm extends \Faderim\Ext\AbstractForm
{

    protected function createChilds()
    {
        $this->setWidth(900);

        $id = new Field\FormField(TypeField::TYPE_NUMBER, 'id', 'Código', false, 13);
        $id->setReadOnly(true);
        $id->setLabelWidth(200);

        $nome = new Field\FormField(TypeField::TYPE_TEXT, 'nome', 'Nome', true, 250);
        $nome->setLabelWidth(200);
        
        $cpf = new Field\FormField(TypeField::TYPE_TEXT, 'cpf', 'CPF', false);        
        $cpf->setLabelWidth(200);

        $rg = new Field\FormField(TypeField::TYPE_NUMBER, 'rg', 'RG', false, 15);        
        $rg->setLabelWidth(200);

        $email = new Field\FormField(TypeField::TYPE_EMAIL, 'email', 'E-mail', true, 250);
        $email->setLabelWidth(200);
        
        $telefone = new Field\FormField(TypeField::TYPE_TEXT, 'telefone', 'Telefone', false);
        $telefone->setLabelWidth(200);
        
        $dataCnh = new Field\FormField(TypeField::TYPE_DATE, 'dataCnh', 'Data CNH', false);
        $dataCnh->setLabelWidth(200);
        
        $dataNasc = new Field\FormField(TypeField::TYPE_DATE, 'dataNascimento', 'Data Nasc.', false);
        $dataNasc->setLabelWidth(200);
        

        $this->addChilds($id, $nome, $cpf,$rg,$email,$telefone,$dataCnh,$dataNasc,  $this->createClienteEndereco());
    }
    
    protected function createClienteEndereco(){
        $clienteEndereco = new \Faderim\Ext\GridForm('clienteEndereco');
        $clienteEndereco->setLinhasIniciais(1);
        $clienteEndereco->setTitle("Endereço");
        $clienteEndereco->setProperty('hiddenButton', true);
        $clienteEndereco->setLayoutStretch(self::LAYOUT_VBOX);
        
        $linha = new \Faderim\Ext\Container('linha');
        $linha->setLayoutStretch();
        
        
        
        $id = new Field\FormField(TypeField::TYPE_TEXT, 'id', 'ID', false, 13);
        $id->setReadOnly(true);
        $id->setHidden();
        $linhaEnd = new \Faderim\Ext\Container('linha_endereco');        
        $linhaEnd->setLayoutStretch(self::LAYOUT_HBOX);
        $endereco = new Field\FormField(TypeField::TYPE_TEXT, 'logradouro', 'Endereço', true, 250);
        $numero = new Field\FormField(TypeField::TYPE_TEXT, 'numero', 'Número', false, 5);
        $linhaEnd->addChilds($endereco,$numero);
        $bairro = new Field\FormField(TypeField::TYPE_TEXT, 'bairro', 'Bairro', true, 150);        
        $complemento = new Field\FormField(TypeField::TYPE_TEXT, 'complemento', 'Comp.', false, 250);        
        $cidade = new Field\FormField(TypeField::TYPE_TEXT, 'cidade', 'Cidade', true, 200);
        $estado = new Field\FormField(TypeField::TYPE_LIST, 'estado', 'Estado', true, 200);
        $estado->getTypeField()->getLocalStore()->setEnumerator(\Seguradora\Model\ClienteEndereco::getEstadoList());
        
        $linha->addChilds($id,$linhaEnd,$bairro,$complemento,$cidade,$estado);
        $clienteEndereco->addChilds($linha);
        return $clienteEndereco;

        
    }

    protected function getFormName()
    {
        return 'form_cliente';
    }

}
