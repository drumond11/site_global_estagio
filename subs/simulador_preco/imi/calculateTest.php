<?php
// Definir constante para indicar que estamos no ambiente de teste
define('IN_TEST_SUITE', true);

require_once 'calculate.php'; 

use PHPUnit\Framework\TestCase;

class calculateTest extends TestCase {

    public function testCalculoIMI() {
        // Simular dados do formulário
        $vpt = 100000; 
        $distrito = 'Funchal';
        $concelho = 'Funchal';
        $tipo_imovel = 'Urbano';
        $num_filhos = 2; 

        // Chamar a função calcularIMI
        $resultado = calcularIMI($vpt, $distrito, $concelho, $tipo_imovel, $num_filhos);

        // Verificar os valores esperados e obtidos usando assertStringContainsString
        $this->assertEquals(230, $resultado['montante_imi'], 'O montante IMI não corresponde ao esperado.');
        $this->assertEquals(12, $resultado['plano_pagamentos_meses'], 'O número de meses no plano de pagamento não corresponde ao esperado.');

        // Verificar o valor mensal formatado
        $valor_mensal_formatado = str_replace(',', '.', $resultado['valor_mensal']);
        $this->assertEquals('19.17', $valor_mensal_formatado, 'O valor mensal não corresponde ao esperado.');

        // Verificar se o cálculo está correto
        $this->assertArrayHasKey('montante_imi', $resultado);
        $this->assertArrayHasKey('plano_pagamentos_meses', $resultado);
        $this->assertArrayHasKey('valor_mensal', $resultado);

        // Verificar se os valores são do tipo correto
        $this->assertIsFloat($resultado['montante_imi']);
        $this->assertIsInt($resultado['plano_pagamentos_meses']);
        $this->assertIsString($resultado['valor_mensal']);
    }
}
?>
