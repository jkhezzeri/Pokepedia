<?php

// Connexion à la base de données

const DB_HOST = 'localhost';
const DB_NAME = 'pokepedia';
const DB_USER = 'root';
const DB_PASSWORD = '';

try {
    $pdo = new PDO(
        sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_NAME),
        DB_USER,
        DB_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $exception) {
    die('Erreur : '.$exception->getMessage());
}
$pdo->exec("SET CHARACTER SET utf8");

?>
