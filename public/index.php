<?php
// В файле public/index.php
use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$methodOverrideMiddleware = new MethodOverrideMiddleware();
$app->add($methodOverrideMiddleware);

// Подключаем файл с базой данных
require_once __DIR__ . '/../config/database.php';

// Подключаем маршруты
require_once __DIR__ . '/../routes/web.php';

// Запуск приложения
$app->run();

