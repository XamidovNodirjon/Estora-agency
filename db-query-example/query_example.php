<?php

require 'db.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
)";
$pdo->exec($sql);

// Ma'lumot qo'shish
$stmt = $pdo->prepare("INSERT INTO users (name) VALUES (:name)");
$stmt->execute(['name' => 'Ali']);

// Ma'lumotni o'zgartirish
$stmt = $pdo->prepare("UPDATE users SET name = :name WHERE id = :id");
$stmt->execute(['name' => 'Vali', 'id' => 1]);

echo "Querylar bajarildi!";
?>