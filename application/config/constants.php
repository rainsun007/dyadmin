<?php
/**
 * 框架版本
 * 版本号规则：
 * 主版本号(较大的变动).子版本号(功能变化或新特性增加).阶段版本号(Bug修复或优化)-版本阶段(base、alpha、beta、RC、release)
 * 上一级版本号变动时下级版本号归零
 **/
define('DYADMIN_VERSION', '2.0.1-release');

//服务地址
define('STATIC_SERVER', '/');
define('BASE_DOMAIN', '/');

//缓存过期时间
define('CACHE_EXPIRE', 86400 * 7);

//发邮件相关配制
define('MAIL_SMTP', 'smtp.exmail.qq.com');
define('MAIL_FROM_NAME', 'Workflow');
define('MAIL_USERNAME', 'sys_service@test.com');
define('MAIL_PASSWORD', '123456');
