<?php

$params = array_replace_recursive(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    // Site name
    'company' => 'MicroPHP News',
    'slogan' => 'Simple news site',
    // Language
    'lang' => 'en',
    // Errors
    'errorController' => '\App\Controllers\DefaultController',
    'errorAction' => 'error',
    // Parameters
    'params' => $params
];
