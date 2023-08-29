<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=biblio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed" . $e->getMessage();
}
