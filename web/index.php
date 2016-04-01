<?php
date_default_timezone_set('Asia/Almaty');


if (substr_count($_SERVER['REQUEST_URI'],'.php')>0) {
    header("Location: /", TRUE, 301);
    exit();
}

$debug = $_SERVER['REMOTE_ADDR'] == '192.168.56.1';
$env = $debug ? 'dev' : 'prod';

if(!empty($_GET['ivphpan']))
{
    setcookie('ivphpan',true,time()+3600*24);
}

if(!empty($_COOKIE['ivphpan']))
{
    $env = 'dev';
    $debug = true;
}

if($env == 'prod')
{
    $debug = false;
}

defined('YII_DEBUG') or define('YII_DEBUG', $debug);
defined('YII_ENV') or define('YII_ENV', $env);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();