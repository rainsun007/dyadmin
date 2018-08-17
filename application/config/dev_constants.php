<?php
/**
 * 框架版本
 * 版本号规则：
 * 主版本号(较大的变动).子版本号(功能变化或新特性增加).阶段版本号(Bug修复或优化)-版本阶段(base、alpha、beta、RC、release)
 * 上一级版本号变动时下级版本号归零
 **/
define('DYADMIN_VERSION', '2.1.0-release');

//服务地址
defined('STATIC_SERVER') or define('STATIC_SERVER', '/');
defined('BASE_DOMAIN') or define('BASE_DOMAIN', '/');

//缓存过期时间(单位：秒)
define('CACHE_EXPIRE', 86400 * 7);

//登录时密码最多输入出错次数（达到此值，账号将被锁定）
define('PW_ERR_MAX_NUM', 3);

//操作超时时间(单位：秒)
define('USER_OP_TIMEOUT', 86400*30);

//侧边导航是否为展开
define('NAV_BAR_ACTIVE', true);

//发邮件相关配制
define('MAIL_SMTP', 'smtp.exmail.qq.com');
define('MAIL_FROM_NAME', 'Workflow');
define('MAIL_USERNAME', 'service@youdomain.com');
define('MAIL_PASSWORD', '123456');
