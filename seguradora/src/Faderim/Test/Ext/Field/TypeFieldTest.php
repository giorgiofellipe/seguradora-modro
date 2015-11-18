<?php

/**
 * Testes dos componentes relacionado a classe Field
 *
 * @author Rodrigo Cândido
 */
class TypeFieldTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Teste do tratamento dos valores retornados
     */
    public function testParseGetModelValue()
    {
        //instancia para acessar o método de tratamento dos valores em branco para os modelos
        $typeField = new \Faderim\Ext\Field\TypeFieldNumber('number_teste');
        $this->assertEquals(0, $typeField->parseGetModelValue(0));
        $this->assertEquals(false, $typeField->parseGetModelValue(false));
        $this->assertNull($typeField->parseGetModelValue('   '));
        $this->assertNull($typeField->parseGetModelValue(''));
    }

}
