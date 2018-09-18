<?php
use Dotenv\Dotenv;
use Noodlehaus\Config;
use App\App;
use Slim\Container;
use Symfony\Component\Cache\Simple\FilesystemCache;

define('INC_ROOT', __DIR__);
require INC_ROOT . '/../vendor/autoload.php';

if(file_exists(INC_ROOT . '/../.env')) {
    $env = new Dotenv(INC_ROOT . '/../');
    $env->load();
 }

$app = new App(new Container(
    include INC_ROOT . '/container.php'
));

$container = $app->getContainer();

$container['config'] = function($c) {
    return new Config(INC_ROOT . '/../config');
};

$container['cache'] = new FilesystemCache;


require INC_ROOT . '/../routes/web.php';
