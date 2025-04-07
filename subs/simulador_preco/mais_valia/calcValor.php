<?php

header('Content-Type: application/json');

class CalcValor {
    public function get_float_param($param_name, $params) {
        if (isset($params[$param_name]) && is_numeric($params[$param_name])) {
            return floatval($params[$param_name]);
        } else {
            throw new InvalidArgumentException("Invalid parameter: $param_name");
        }
    }

    public function calculate($params) {
        $valorAqui = $this->get_float_param('input_valorAquisicao', $params);
        $valorVenda = $this->get_float_param('input_valorVenda', $params);
        $valorDesp = $this->get_float_param('input_valorDespesa', $params);
        $valorMonetario_anoAquisicao = $this->get_float_param('input_valorMonetarioAnoAquisicao', $params);
        $valorMonetario_anoVenda = $this->get_float_param('input_valorMonetarioAnoVenda', $params);

        // Calculos
        $calculo = $valorVenda - ($valorAqui * ($valorMonetario_anoAquisicao / $valorMonetario_anoVenda)) - $valorDesp;
        $taxa = $calculo / 2;
        $taxa_abater = 0;

        //------------------------------------------ inicio da Verificações --------------------------------------
        if ($taxa < 0) {
            $calculo = 0;
            $taxa = 0;
        } else if ($taxa <= 7112) {
            $taxa_abater = $taxa * 0.145;
        } else if ($taxa < 10732) {
            $taxa_abater = $taxa * 0.23;
        } else if ($taxa < 20322) {
            $taxa_abater = $taxa * 0.285;
        } else if ($taxa < 25075) {
            $taxa_abater = $taxa * 0.35;
        } else if ($taxa < 36967) {
            $taxa_abater = $taxa * 0.37;
        } else if ($taxa < 80882) {
            $taxa_abater = $taxa * 0.45;
        } else {
            $taxa_abater = $taxa * 0.48;
        }
        //-------------------------------------------- fim da Verificação -------------------------------------------

        // preparação do resultado em json
        return array(
            "success" => true,
            "valor_mais_valia" => $calculo,
            "valor_taxa" => $taxa,
            "valor_taxa_abater" => $taxa_abater
        );
    }
}

try {
    $params = $_POST;
    $calculator = new CalcValor();
    $result = $calculator->calculate($params);
    echo json_encode($result);
} catch (InvalidArgumentException $e) {
    echo json_encode(array("success" => false, "error" => $e->getMessage()));
}
?>