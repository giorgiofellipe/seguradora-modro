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
        
        $cpf = new Field\FormField(TypeField::TYPE_CPF, 'cpf', 'CPF', false);        
        $cpf->setLabelWidth(200);

        $rg = new Field\FormField(TypeField::TYPE_NUMBER, 'rg', 'RG', false, 15);        
        $rg->setLabelWidth(200);

        $email = new Field\FormField(TypeField::TYPE_EMAIL, 'email', 'E-mail', true, 250);
        $email->setLabelWidth(200);
        
        $telefone = new Field\FormField(TypeField::TYPE_PHONE, 'telefone', 'Telefone', false);
        $telefone->setLabelWidth(200);
        
        $dataCnh = new Field\FormField(TypeField::TYPE_DATE, 'dataCnh', 'Data CNH', false);
        $dataCnh->setLabelWidth(200);
        
        $dataNasc = new Field\FormField(TypeField::TYPE_DATE, 'dataNasc', 'Data Nasc.', false);
        $dataNasc->setLabelWidth(200);

        

        $this->addChilds($id, $nome, $cpf,$rg,$email,$telefone,$dataCnh,$dataNasc);
    }

    protected function getFormName()
    {
        return 'form_cliente';
    }

}
