<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handler(
    $request = illuminate\http\Request::capture()
);

$response->send();
$kernel->terminate($request, $response);
