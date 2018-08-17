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

    $dyaConfig = dirname(__FILE__).'/application/config/config.php';
    $pConfig = dirname(__FILE__).'/../application/config/config.php';

    $debug = false;

    //加载dyphpFramwork
    require dirname(__FILE__).'/../dyphpframework/dyphp.php';
}

if(file_exists($pConfig)){
    $config = array('p'=>$pConfig,'c'=>$dyaConfig,'e'=>array('db','appName'));
} else {
    $config = $dyaConfig;
}

//运行app
Dy::runWebApp($config, $debug);
