<?php

// Incluir o arquivo que contém a função a ser testada
require_once 'simulador.php';

class test extends PHPUnit\Framework\TestCase {

    // Teste para verificar o cálculo do empréstimo com valores válidos
    public function testCalculoEmprestimoComValoresValidos() {
        // Valores de exemplo
        $valor = 10000;
        $taxa = 5;
        $spread = 1;
        $parcelas = 12;

        // Chama a função para calcular o empréstimo
        $resultado = calcularEmprestimo($valor, $taxa, $spread, $parcelas);

        // Verifica se o resultado é um array e se possui a chave "success" igual a true
        $this->assertTrue(is_array($resultado));
        $this->assertTrue($resultado['success']);

        // Verifica se os valores calculados estão corretos
        $this->assertEquals($resultado['valor'], $valor);
        $this->assertEquals($resultado['taxaEfetiva'], $taxa + $spread);
        $this->assertEquals(count($resultado['tabela']), $parcelas);
    }

    // Teste para verificar o tratamento de valores inválidos
    public function testCalculoEmprestimoComValoresInvalidos() {
        // Valores de exemplo inválidos (parcelas negativas)
        $valor = 10000;
        $taxa = 5;
        $spread = 1;
        $parcelas = -1;

        // Chama a função para calcular o empréstimo
        $resultado = calcularEmprestimo($valor, $taxa, $spread, $parcelas);

        // Verifica se o resultado é um array e se possui a chave "success" igual a false
        $this->assertTrue(is_array($resultado));
        $this->assertFalse($resultado['success']);
    }

    // Teste para verificar o tratamento de valor zero
    public function testCalculoEmprestimoComValorZero() {
        // Valor de exemplo zero
        $valor = 0;
        $taxa = 5;
        $spread = 1;
        $parcelas = 12;

        // Chama a função para calcular o empréstimo
        $resultado = calcularEmprestimo($valor, $taxa, $spread, $parcelas);

        // Verifica se o resultado é um array e se possui a chave "success" igual a false
        $this->assertTrue(is_array($resultado));
        $this->assertFalse($resultado['success']);
    }

}