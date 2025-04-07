<?php

class FinancialCalculator {
    public function get_float_param($param_name, $params) {
        if (isset($params[$param_name]) && is_numeric($params[$param_name])) {
            return floatval($params[$param_name]);
        } else {
            throw new InvalidArgumentException("Invalid parameter: $param_name");
        }
    }

    public function calculate_percentage($params) {
        $valorMensal = $this->get_float_param('input_RendimentoMensal', $params);
        $valor_creditoHabitacao = $this->get_float_param('input_creditoHabitacao', $params);
        $valor_credioAuto = $this->get_float_param('input_creditoAutomovel', $params);
        $valor_creditoPessoal = $this->get_float_param('input_creditoPessoal', $params);
        $valor_dividas_cartaoCredito = $this->get_float_param('input_dividas_cartaoCredito', $params);
        $valor_outrosCreditos = $this->get_float_param('input_outrosCreditos', $params);
        $valor_encargosDomesticos = $this->get_float_param('input_encargosDomesticos', $params);

        $total_prestacoes_financeiras = $valor_creditoHabitacao + $valor_credioAuto + $valor_creditoPessoal + $valor_dividas_cartaoCredito + $valor_outrosCreditos + $valor_encargosDomesticos;
        $calculo_percentagem = ($total_prestacoes_financeiras / $valorMensal) * 100;

        return $calculo_percentagem;
    }
}
?>