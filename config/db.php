<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => env('DB_CONNECTION').':host='.env('DB_HOST').';port='.env('DB_PORT').';dbname='.env('DB_NAME'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
