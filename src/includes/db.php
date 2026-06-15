<?php
// Maakt een PDO-verbinding met de database

function maakVerbinding(): PDO
{
    $config = require __DIR__ . '/../config/database.php';

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        $config['host'],
        $config['database'],
        $config['charset']
    );

    $opties = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new PDO($dsn, $config['user'], $config['password'], $opties);
}
