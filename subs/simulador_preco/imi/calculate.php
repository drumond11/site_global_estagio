<?php
// Verificar se a constante IN_TEST_SUITE está definida (para PHPUnit)
if (!defined('IN_TEST_SUITE')) {
    // Definir o cabeçalho apenas se não estiver no ambiente de teste
    header('Content-Type: application/json');
}

function calcularIMI($vpt, $distrito, $concelho, $tipo_imovel, $num_filhos) {
    // Verificar se todos os dados estão presentes e são válidos
    if ($vpt <= 0 || empty($distrito) || empty($concelho) || empty($tipo_imovel)) {
        return ["error" => "Todos os campos são obrigatórios e devem ser válidos."];
    }

    // Definir a taxa de IMI base de acordo com o tipo de imóvel
    $taxa_imi = 0;
    if ($tipo_imovel == "Urbano") {
        $taxa_imi = 0.3; // Exemplo de taxa para Prédio Urbano, varia entre 0,3% e 0,45% para prédios urbanos
    } else if ($tipo_imovel == "Rustico") {
        $taxa_imi = 0.8; // Exemplo de taxa para Prédio Rústico
    }

    // Aplicar redução de acordo com o número de filhos
    $reducao = 0;
    if ($num_filhos == 1) {
        $reducao = 30; // 30 euros de redução para 1 filho
    } else if ($num_filhos == 2) {
        $reducao = 70; // 70 euros de redução para 2 filhos
    } else if ($num_filhos >= 3) {
        $reducao = 140; // 140 euros de redução para 3 ou mais filhos
    }

    // Calcular o IMI
    $imi = $vpt * ($taxa_imi / 100) - $reducao;
    if ($imi < 0) {
        $imi = 0; // O IMI não pode ser negativo
    }

    // Montante de IMI a pagar
    $montante_imi = floatval($imi);

    // Dividir o montante do IMI por 2 meses
    $plano_pagamentos_meses = 2;
    $valor_mensal = $imi / $plano_pagamentos_meses;
    $valor_mensal_formatado = number_format($valor_mensal, 2, ',', '.');

    // Construir resposta em JSON com apenas dois meses
    $response = [
        "montante_imi" => $montante_imi,
        "valor_mensal" => $valor_mensal_formatado,
        "meses" => [
            "1ª prestação mensal" => $valor_mensal_formatado,
            "2ª prestação mensal" => $valor_mensal_formatado
        ]
    ];

    return $response;
}

// Verificar método de requisição de forma segura
$method = $_SERVER["REQUEST_METHOD"] ?? '';
if ($method === "POST") {
    // Receber dados do formulário (usando ternário para evitar índices indefinidos)
    $vpt = isset($_POST['vpt']) ? (float)$_POST['vpt'] : 0;
    $distrito = isset($_POST['distrito']) ? $_POST['distrito'] : '';
    $concelho = isset($_POST['concelho']) ? $_POST['concelho'] : '';
    $tipo_imovel = isset($_POST['tipo_imovel']) ? $_POST['tipo_imovel'] : '';
    $num_filhos = isset($_POST['num_filhos']) ? (int)$_POST['num_filhos'] : 0;

    // Calcular IMI
    $response = calcularIMI($vpt, $distrito, $concelho, $tipo_imovel, $num_filhos);

    // Devolver os dados em formato JSON
    echo json_encode($response);
}
?>
