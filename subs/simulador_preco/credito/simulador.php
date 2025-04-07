<?php
// Verificar se a constante IN_TEST_SUITE não está definida (para PHPUnit)
if (!defined('IN_TEST_SUITE')) {
    // Definir o cabeçalho apenas se não estiver no ambiente de teste
    header('Content-Type: application/json');
}

require_once 'funcoes.php';

$response = ["success" => false];

$method = $_SERVER["REQUEST_METHOD"] ?? '';
if ($method === "POST") {
    // Captura os valores do formulário
    $valor = isset($_POST['valor']) ? floatval($_POST['valor']) : 0;
    $taxa = isset($_POST['taxa']) ? floatval($_POST['taxa']) : 0;
    $spread = isset($_POST['spread']) ? floatval($_POST['spread']) : 0;
    $parcelas = isset($_POST['parcelas']) ? intval($_POST['parcelas']) : 0;

    // Validação adicional para taxa de juros e spread bancário
    if (function_exists('validarTaxaSpread') && validarTaxaSpread($taxa) && validarTaxaSpread($spread) && $valor > 0 && $parcelas > 0) {

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
}

// Converte a resposta para JSON
echo json_encode($response);
?>
