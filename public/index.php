<?php

declare(strict_types=1);

use App\Cor\RequestHandler;

require_once(__DIR__ ."/../vendor/autoload.php");

const PROJECT_DIR = __DIR__ . '/..';

const DB_DSN = 'sqlite:../var/db';

$request = \App\Routing\Request::initFromGlobals();
$controller = (new RequestHandler())->handle($request);

echo $controller;