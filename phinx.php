<?php

require __DIR__ . '/vendor/autoload.php';

if(file_exists(__DIR__ . '/.env')) {
    $dotenv = new \Dotenv\Dotenv(__DIR__);
    $dotenv->overload();
}

$db = include __DIR__ . '/config/db.php';

//PHP 7.1 - incluir os parâmetros  para o list,
//possibilitando a informação a se buscar no array, apontando para a
//variável criada, em vez de usar $db['driver', etc..]
list(
    'driver' => $adapter,
    'host' => $host,
    'database' => $name,
    'username' => $user,
    'password' => $pass,
    'charset' => $charset,
    'collation' => $collation
    ) = $db ['default_connection'];
return [
    'paths' => [
        'migrations' => [
            __DIR__ . '/db/migrations'
        ],
        'seeds' => [
            __DIR__ . '/db/seeds'
        ]
    ],
    'environments' => [
        //Informar ao Phinx quais tabelas já foram migradas
        'default_migration_table' => 'migrations',
        'default_database' => 'default_connection',
        'default_connection' => [
            'adapter' => $adapter,
            'host' => $host,
            'name' => $name,
            'user' => $user,
            'pass' => $pass,
            'charset' => $charset,
            'collation' => $collation
        ]
    ]
];