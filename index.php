<?php

//环境配制
$appEnv = getenv('PHP_RUNTIME_ENVIROMENT');

if ($appEnv === 'DEV') {
    error_reporting(E_ALL); 

    $dyaConfig = dirname(__FILE__).'/application/config/dev_config.php';
    $pConfig = dirname(__FILE__).'/../application/config/dev_config.php';

    $debug = true;

    //加载dyphpFramwork
    require getenv('DYPHP_FRAMEWORK');

} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);

    $dyaConfig = dirname(__FILE__).'/application/config/pro_config.php';
    $pConfig = dirname(__FILE__).'/../application/config/pro_config.php';

    $debug = false;

    //加载dyphpFramwork
    require dirname(__FILE__).'/../DyphpFramework/dyphp.php';
}

//运行app
$config = file_exists($pConfig) ? array('p'=>$pConfig,'c'=>$dyaConfig) : $dyaConfig;
Dy::runWebApp($config, $debug);
