<?php
// Database configuratie
// Deze waarden komen overeen met de instellingen in docker-compose.yml

return [
    'host'     => getenv('DB_HOST') ?: 'mysql',
    'database' => getenv('DB_NAME') ?: 'contactdb',
    'user'     => getenv('DB_USER') ?: 'appuser',
    'password' => getenv('DB_PASSWORD') ?: 'apppass',
    'charset'  => 'utf8mb4',
];
