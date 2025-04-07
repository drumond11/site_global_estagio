<?php
require_once 'calcValor.php';

use PHPUnit\Framework\TestCase;

class test extends TestCase
{
    public function testCalculateWithValidInput()
    {
        // Simulate valid $_POST data
        $params = [
            'input_valorAquisicao' => 300,
            'input_valorVenda' => 600,
            'input_valorDespesa' => 0,
            'input_valorMonetarioAnoAquisicao' => 2024,
            'input_valorMonetarioAnoVenda' => 2024
        ];

        $calculator = new CalcValor();
        $result = $calculator->calculate($params);

        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('valor_mais_valia', $result);
        $this->assertArrayHasKey('valor_taxa', $result);
        $this->assertArrayHasKey('valor_taxa_abater', $result);
        $this->assertEquals(300, $result['valor_mais_valia']);
        $this->assertEquals(150, $result['valor_taxa']);
        $this->assertEquals(21.75, $result['valor_taxa_abater']);
        echo "\n\nValor mais Valia: $result[valor_mais_valia]\n Valor taxa: $result[valor_taxa]\n Valor taxa abater: $result[valor_taxa_abater]";
    }

    public function testCalculateWithInvalidInput()
    {
        // simular invalido $_POST dados (falta de input)
        $params = [
            // a faltar 'input_valorAquisicao'
            'input_valorVenda' => 15000,
            'input_valorDespesa' => 500,
            'input_valorMonetarioAnoAquisicao' => 2020,
            'input_valorMonetarioAnoVenda' => 2023
        ];

        $calculator = new CalcValor();

        // a expera de erro
        $this->expectException(InvalidArgumentException::class);
        $calculator->calculate($params);
    }
}
?>