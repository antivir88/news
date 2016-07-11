<?php

require __DIR__ . '/../app/_bootstrap.php';
require __DIR__ . '/../app/Application.php';

$app = new \App\Application('devel', false);

$response = $app->run(new \Micro\Web\Request);
$response->send();

$app->terminate();
