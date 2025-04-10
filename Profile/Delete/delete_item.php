<?php
$host = 'localhost';
$dbname = 'хапай_look';
$username = 'root';
$password = '9876543210';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Помилка підключення: ' . $e->getMessage()]);
    exit();
}

if (isset($_POST['basket_id'])) {
    $basketId = (int)$_POST['basket_id'];

    // Видалення товару з кошика за його ID
    $stmt = $pdo->prepare("DELETE FROM basket WHERE basket_id = :basket_id");
    $stmt->bindParam(':basket_id', $basketId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Не вдалося видалити товар']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID кошика не вказано']);
}
