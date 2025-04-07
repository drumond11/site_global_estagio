<?php
require_once 'FinancialCalculator.php';

header('Content-Type: application/json');

$params = $_POST;

try {
    $calculator = new FinancialCalculator();
    $percentage = $calculator->calculate_percentage($params);

    $result = array(
        "success" => true,
        "percentagem_taxa" => $percentage
    );
} catch (InvalidArgumentException $e) {
    $result = array(
        "success" => false,
        "error" => $e->getMessage()
    );
}

echo json_encode($result);
?>