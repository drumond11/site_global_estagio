<?php

// Função auxiliar para validar taxa de juros e spread
function validarTaxaSpread($valor) {
    // Lógica de validação (exemplo simples)
    return $valor >= 0;
}

// Função para calcular o empréstimo
function calcularEmprestimo($valor, $taxa, $spread, $parcelas) {
    $response = ["success" => false];

    // Validação adicional para taxa de juros e spread bancário
    if (validarTaxaSpread($taxa) && validarTaxaSpread($spread) && $valor > 0 && $parcelas > 0) {

        // Calcula a taxa de juros efetiva considerando o spread bancário
        $taxaEfetiva = $taxa + $spread;

        // Converte a taxa anual para mensal
        $taxaMensal = ($taxaEfetiva / 100) / 12;

        // Calcula o valor da parcela usando a fórmula do valor presente de uma anuidade (empréstimo)
        $parcela = $valor * $taxaMensal / (1 - pow(1 + $taxaMensal, -$parcelas));

        // Inicializa variáveis para a tabela de amortização
        $saldoDevedor = $valor;
        $jurosTotal = 0;
        $amortizacaoTotal = 0;
        $tabela = [];

        // Loop para calcular os valores mês a mês
        for ($mes = 1; $mes <= $parcelas; $mes++) {
            // Cálculo dos juros do mês
            $jurosMes = $saldoDevedor * $taxaMensal;
            $jurosTotal += $jurosMes;

            // Cálculo da amortização do mês
            $amortizacao = $parcela - $jurosMes;
            $amortizacaoTotal += $amortizacao;

            // Atualiza o saldo devedor após o pagamento da parcela
            $saldoDevedor -= $amortizacao;

            // Adiciona os valores na tabela
            $tabela[] = [
                "mes" => $mes,
                "parcela" => $parcela,
                "juros" => $jurosMes,
                "amortizacao" => $amortizacao,
                "saldoDevedor" => $saldoDevedor
            ];
        }

        $response = [
            "success" => true,
            "valor" => $valor,
            "taxaEfetiva" => $taxaEfetiva,
            "parcelas" => $parcelas,
            "parcela" => $parcela,
            "tabela" => $tabela,
            "jurosTotal" => $jurosTotal,
            "amortizacaoTotal" => $amortizacaoTotal
        ];
    }

    return $response;
}
?>
