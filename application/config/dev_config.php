<?php

DyCfg::setPathOfAlias('com', '../');

return array(
    //app唯一id  session key的前缀中使用到 解决多应用session冲突
    'appID' => 'dyadmin',
    //app根地址
    'appPath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    //app名 用于title显示
    'appName' => 'DyAdmin',
    //app错误框架提示语言 现只支持zh_cn
    'language' => 'zh_cn',
    //app密钥 cookie session string等加密  不同应用此密钥应唯一
    'secretKey' => 'dyphp1x8K$8yrG8#5CzTw7u^ntci8t@idev',
    //运行环境dev,test,pro,pre   用于加载不同环境的constants暂时只有这一个用途  不设置或为空时加载constants.php
    'env' => 'dev',

    //预加载文件及包含路径
    'import' => array(
        'app.utils.*',
    ),

    //类及命名空间别名映射
    'aliasMap' => array(
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

    //建议按console web类型做不同处理
    //自定义错误处理句柄 默认为app/error
    'errorHandler' => 'app/error',
    //自定义message处理句柄 默认为app/message
    'messageHandler' => 'app/message',
    //自定义登陆处理句柄 默认为app/login
    'loginHandler' => 'app/login',

    //自定义参数配制
    'params' => array(
        'version' => 'Release 1.0',
    ),
);
