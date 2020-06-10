<?php

return array(
    //app根地址
    'appPath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    //app名 用于title显示
    'appName' => 'DyAdmin',
    //app错误框架提示语言 现只支持zh_cn
    'language' => 'zh_cn',
    //app密钥 cookie session string等加密  不同应用此密钥应唯一
    'secretKey' => 'dyphpAdmin1x8K$8yrG8#5CzTw7u^ntci8t@ipro',
    //运行环境dev(开发),test(测试),pre(预发布),pro(发布)
    'env' => 'pro',

    //预加载文件及包含路径
    'import' => array(
        'app.utils.*',
    ),

    //类及命名空间别名映射
    'aliasMap' => array(
        'VHelper' => 'app.utils.ViewHelper',
    ),

    //数据库配制  数据分库或一主多从或多主多从 必须实现每个model的dbConfig方法
    /*
    'db' => array(
        'default' => array(
            'master' => array(
                'dbDriver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'port' => '3318',
                'dbName' => 'dyadmin',
                'charset' => 'UTF8',
                'user' => 'root',
                'pass' => '',
                'pconn' => false,
                'tablePrefix' => '',
            ),
            'slaves' => array(
                array(
                    'dbDriver' => 'pdo_mysql',
                    'host' => '127.0.0.1',
                    'port' => '3318',
                    'dbName' => 'dyadmin',
                    'charset' => 'UTF8',
                    'user' => 'root',
                    'pass' => '',
                    'pconn' => false,
                    'tablePrefix' => '',
                ),
            ),
        ),
    ),
    */
    
    'db' => array(
        'default' => array(
            'dbDriver' => 'pdo_mysql',
            'host' => '172.66.60.191',
            'port' => '3306',
            'dbName' => 'dyadmin',
            'charset' => 'UTF8',
            'user' => 'root',
            'pass' => '',
            'pconn' => false,
            'tablePrefix' => '',
        ),
    ),

    /*
     * URL管理
     * ca,ext_name,page为框架保留的get参数
     */
    'urlManager' => array(
        'urlStyle' => array('hideIndex' => 'yes', 'restCa' => 'yes'),
        '/admin/login' => array('controller' => 'admin/home', 'action' => 'login'),
        '/dashboard' => array('controller' => 'admin/home', 'action' => 'index'),
    ),

    //cookie配制
    'cookie' => array(
        'secretKey' => 'dyadmin_secretKey_K$8yrG8#5CzTw7u^ntci8ter67231@pro',
        'prefix' => 'dya_',
    ),

    //缓存配制 'file','apc','memcache'
    'cache' => array(
        'default' => array('type' => 'file', 'gcOpen' => false),  //文件缓存多时 不建议打开gc 会导致性能低下  可以使用shell处理
        /*
        'c2' => array('type' => 'apc'),
        'c3' => array(
            'type' => 'memcache',
            'isMemd' => false,
            'servers_one' => array(
                array('host', 'port', 'weight'),
                array('host', 'port', 'weight'),
            ),
        ),
        */
    ),

    'hooks'=>array(
        'enable'=>true,
        'after_action'=>array(
            'enable'=>true,
            'AdminUserOpHook'=> array('userOpTime'),
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
        'dyadmin_modules' => array('admin','workflow'),
    ),
);
