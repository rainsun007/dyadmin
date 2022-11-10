<?php

return array(
    //app根地址
    'appPath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    //app名 用于title显示
    'appName' => 'DyAdmin',
    //app错误框架提示语言 现只支持zh_cn
    'language' => 'zh_cn',
    //app密钥 cookie session string等加密  不同应用此密钥应唯一
    'secretKey' => 'dyphpAdmin1x8K$8yrG8#5CzTw7u^ntci8t@idev',
    //运行环境dev(开发),test(测试),pre(预发布),pro(发布)
    'env' => 'dev',

    //预加载文件及包含路径
    'import' => array(
        //'app.utils.*',
        'app.utils.Common',
    ),

    //类及命名空间别名映射
    'aliasMap' => array(
        'VHelper' => 'app.utils.ViewHelper',
    ),

    //数据库配制
    'db' => array(
        'default' => array(
            'dbDriver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'dbName' => 'dyadmin',
            'charset' => 'UTF8',
            'user' => 'root',
            'pass' => '123456',
            'pconn' => false,
            'tablePrefix' => '',
        ),
    ),

    /*
     * URL管理
     * ca,ext_name,page为框架保留的get参数,不可被占用
     * urlStyle为路由管理系统key,不可被占用
     */
    'urlManager' => array(
        'urlStyle' => array('hideIndex' => 'yes', 'restCa' => 'yes'),
        '/admin/login' => array('controller' => 'admin/home', 'action' => 'login'),
        '/dashboard' => array('controller' => 'admin/home', 'action' => 'index'),
    ),

    //cookie配制
    'cookie' => array(
        'secretKey' => 'dyadmin_secretKey_K$8yrG8#5CzTw7u^ntci8ter67231@dev',
        'prefix' => 'dya_',
        //'domain' => 'mysite.com',
    ),

    //缓存配制
    'cache' => array(
        'default' => array('type' => 'file', 'gcOpen' => false),
    ),

    'hooks' => array(
        'enable' => true,
        'after_action' => array(
            'enable' => true,
            'AdminUserOpHook' => array('userOpTime'),
        ),
    ),

    //建议按console web类型做不同处理
    //自定义错误处理句柄 默认为app/error
    'errorHandler' => 'app/error',
    //自定义message处理句柄 默认为app/message
    'messageHandler' => 'app/message',
    //自定义登陆处理句柄 默认为app/login
    'loginHandler' => 'app/login',

    //自定义参数配制
    'params' => array(
        'dyadmin_modules' => array('admin', 'workflow'),
    ),
);
