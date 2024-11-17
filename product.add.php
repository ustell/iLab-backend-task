<?php
header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Некорректные JSON-данные.',
        'json_error' => json_last_error_msg(),
        'received_data' => $json
    ]);
    exit;
}


if (!isset($data['products']) || !is_array($data['products'])) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректные данные товаров.']);
    exit;
}

require_once 'Product.php';

foreach ($data['products'] as $product) {
    $requiredFields = ['id', 'name', 'price', 'currency', 'quantity', 'images'];

    $missingFields = [];
    foreach ($requiredFields as $field) {
        if (!isset($product[$field])) {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Отсутствуют обязательные поля: ' . implode(', ', $missingFields)
        ]);
        exit;
    }

    try {
        Product::add($product);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка базы данных: ' . $e->getMessage()]);
        exit;
    }
}

echo json_encode(['status' => 'success', 'message' => 'Товары успешно добавлены.']);
?>
