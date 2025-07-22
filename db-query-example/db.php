<?php
// filepath: c:\Users\Asus\Desktop\Projects\UyTop\db.php

$host = 'localhost';
$db   = 'v2';
$user = 'postgres';
$pass = 'root123';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB ulanishda xatolik: " . $e->getMessage());
}
?>