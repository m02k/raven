<?php
use App\controllers\ApiController;
require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use App\app\Application;

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
session_start();

$app = new Application(dirname(__DIR__), $config);


include_once(dirname(__DIR__).'/routes/web.php');
include_once(dirname(__DIR__).'/routes/api.php');
//$app->router->middleware(['post', 'get'], 'blog/xyz', [ApiController::class,'test'],'testing');
$app->run();










?>
