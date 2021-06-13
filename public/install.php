<?php

function runInstall($envFile)
{
    if(file_exists($envFile)){
        return true;
    }

    $db_params = [
        'DB_DRIVER' => 'hello',//$_POST['db_driver'],
        'DB_HOST' => 'hello', //$_POST['db_host'],
        'DB_USER' => 'hello', //$_POST['db_user'],
        'DB_PASSWORD' => 'hello', //$_POST['db_password'],
    ];

    $email_params = [
        'HOST' => 'stmp.gmail.com',
        'USERNAME' => '',
        'PASSWORD' => '',
        'STMP_SECURE' => 'ssl',
        'PORT' => 465
    ];

    file_get_contents($envFile);

    foreach($db_params as $key => $value ){
        file_put_contents($envFile, $key . "=" . $value .PHP_EOL, FILE_APPEND);
    }

    return true;

    
}