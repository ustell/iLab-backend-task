<?php
require_once 'db_connect.php';

class Product {
    public static function add($productData) {
        global $pdo;

        $sql = "INSERT INTO products (id, name, price, currency, quantity, category_name, barcode, description, images) VALUES (:id, :name, :price, :currency, :quantity, :category_name, :barcode, :description, :images)";

        $stmt = $pdo->prepare($sql);
        $imagesJson = json_encode($productData['images']);

        $stmt->execute([
            ':id' => $productData['id'],
            ':name' => $productData['name'],
            ':price' => $productData['price'],
            ':currency' => $productData['currency'],
            ':quantity' => $productData['quantity'],
            ':category_name' => $productData['category_name'],
            ':barcode' => $productData['barcode'],
            ':description' => $productData['description'],
            ':images' => $imagesJson
        ]);
    }
}
?>
