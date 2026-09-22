<?php
date_default_timezone_set('Europe/Amsterdam');

$dbhost = 'mariadb';
$dbname = 'fitness';
$dbuser = 'user';
$dbpass = 'password';

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
