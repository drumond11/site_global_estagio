<?php
use PHPUnit\Framework\TestCase;

require_once 'FinancialCalculator.php';

class test extends TestCase {
    public function testCalculatePercentage() {
        $calculator = new FinancialCalculator();

        $params = array(
            'input_RendimentoMensal' => '5000',
            'input_creditoHabitacao' => '1000',
            'input_creditoAutomovel' => '500',
            'input_creditoPessoal' => '200',
            'input_dividas_cartaoCredito' => '300',
            'input_outrosCreditos' => '100',
            'input_encargosDomesticos' => '400'
        );

        $expectedPercentage = 50;
        $obtainedPercentage = $calculator->calculate_percentage($params);

        echo "Expected: $expectedPercentage, Obtained: $obtainedPercentage\n";

        $this->assertEquals($expectedPercentage, $obtainedPercentage);
    }

    public function testInvalidParameter() {
        $calculator = new FinancialCalculator();

        $params = array(
            'input_RendimentoMensal' => '5000',
            'input_creditoHabitacao' => '1000',
            'input_creditoAutomovel' => '500',
            'input_creditoPessoal' => '200',
            'input_dividas_cartaoCredito' => 'invalid', // invalid parameter
            'input_outrosCreditos' => '100',
            'input_encargosDomesticos' => '400'
        );

        $this->expectException(InvalidArgumentException::class);

        try {
            $calculator->calculate_percentage($params);
        } catch (InvalidArgumentException $e) {
            echo "Caught exception: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}
?>