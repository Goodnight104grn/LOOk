<?php
$host = 'localhost';  
$dbname = 'хапай_look'; 
$username = 'root';  
$password = '9876543210';  

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '<p style="color: green;">Підключення до бази даних успішне!</p>';
} catch (PDOException $e) {
    echo '<p style="color: red;">Помилка підключення: ' . $e->getMessage() . '</p>';
}
?>
