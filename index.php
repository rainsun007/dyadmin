<?php
//环境配制
$appEnv = getenv('PHP_RUNTIME_ENVIROMENT');
if ($appEnv === 'DEV') {
    error_reporting(E_ALL);  //error_reporting(0) && DyPhpBase::$debug == false时页面空白（即不调用config中自定义的errorHandler）
    $config = dirname(__FILE__).'/application/config/dev_config.php';
    $debug = true;
} else {
    error_reporting(E_ALL);
    $config = dirname(__FILE__).'/application/config/config.php';
    $debug = false;
}

//加载dyphpFramwork
require dirname(__FILE__).'/../dyframework/dyphp.php';

//运行app
Dy::runWebApp($config, $debug);
