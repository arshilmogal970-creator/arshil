<?php
$config = require __DIR__ . '/app.php';

function getDbConfig(): array {
    static $cfg = null;
    if ($cfg === null) {
        $cfg = require __DIR__ . '/app.php';
    }
    return $cfg['db'];
}

function getDbConnection(): PDO {
    $db = getDbConfig();
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $db['host'], $db['name'], $db['charset']);
    $pdo = new PDO($dsn, $db['user'], $db['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}
