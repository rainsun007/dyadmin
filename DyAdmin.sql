-- --------------------------------------------------------
-- 主机:                           vpn.dysite.vip
-- 服务器版本:                        8.0.13 - Source distribution
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  12.0.0.6527
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- 导出 dyadmin 的数据库结构
CREATE DATABASE IF NOT EXISTS `dyadmin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `dyadmin`;

-- 导出  表 dyadmin.dya_member 结构
CREATE TABLE IF NOT EXISTS `dya_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `realname` varchar(50) DEFAULT '' COMMENT '真实姓名',
  `password` varchar(50) NOT NULL DEFAULT '',
  `role_ids` tinytext COMMENT '用户对应的角色id集合',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为正常  0为禁用',
  `email` varchar(100) DEFAULT '',
  `phone` varchar(20) DEFAULT '',
  `intro` tinytext COMMENT '简介',
  `sign` varchar(150) DEFAULT '' COMMENT '个人签名',
  `avatar` varchar(150) DEFAULT '' COMMENT '头像',
  `pw_err_num` tinyint(1) NOT NULL DEFAULT '0' COMMENT '密码错误次数',
  `create_time` datetime NOT NULL COMMENT '用户加入时间',
  `last_op_time` datetime NOT NULL COMMENT '最后操作时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- 正在导出表  dyadmin.dya_member 的数据：~5 rows (大约)
INSERT INTO `dya_member` (`id`, `username`, `realname`, `password`, `role_ids`, `status`, `email`, `phone`, `intro`, `sign`, `avatar`, `pw_err_num`, `create_time`, `last_op_time`) VALUES
	(1, 'admin', '管理员', 'e10adc3949ba59abbe56e057f20f883e', '1', 1, 'rain@test.com', '123456789', NULL, '', '/upload/face/1_100.jpg', 0, '0000-00-00 00:00:00', '2022-11-08 10:30:18'),
	(4, 'demoqflkjdsalfj', '测试', 'e10adc3949ba59abbe56e057f20f883e', '3', 1, 'ssssss@test.com', '', NULL, '', '', 0, '2016-10-06 10:13:19', '0000-00-00 00:00:00'),
	(5, 'test1', '测试2', 'fcea920f7412b5da7be0cf42b8c93759', '3', 1, 'qqqqq@test.com', '', NULL, '', '', 0, '2017-05-09 14:07:22', '0000-00-00 00:00:00');
INSERT INTO `dya_member` (`id`, `username`, `realname`, `password`, `role_ids`, `status`, `email`, `phone`, `intro`, `sign`, `avatar`, `pw_err_num`, `create_time`, `last_op_time`) VALUES
	(6, 'demouser', '测试号', 'b245022c776dbc656eb07c9abb9b6050', '3', 1, 'sssssssss@163.com', '', NULL, '', '', 0, '2017-06-23 14:59:58', '0000-00-00 00:00:00'),
	(7, 'userloginname', '真名', 'e10adc3949ba59abbe56e057f20f883e', '3', 0, '123456@qq.com', '15900138000', NULL, '', '', 0, '2022-10-09 19:54:21', '2022-10-09 19:54:21');

-- 导出  表 dyadmin.dya_nav 结构
CREATE TABLE IF NOT EXISTS `dya_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL COMMENT '菜单名',
  `link` varchar(200) DEFAULT '' COMMENT 'url地址',
  `icon` varchar(200) DEFAULT '' COMMENT 'icon class',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为显示，0为不显示（type=0时有效，即只有导航有此属性）',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航菜单排序（type=0时有效，即只有导航有此属性）',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为正常导航菜单  1为菜单内关联操作（权限）',
  `sys` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0普通导航 1为系统导航',
  PRIMARY KEY (`id`),
  KEY `link` (`link`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='导航与权限统一使用此表';

-- 正在导出表  dyadmin.dya_nav 的数据：~33 rows (大约)
INSERT INTO `dya_nav` (`id`, `pid`, `name`, `link`, `icon`, `display`, `sort`, `type`, `sys`) VALUES
	(19, 0, '看板视图', '', 'fa fa-dashboard', 1, 0, 0, 0),
	(20, 19, '系统看板', '/admin/home/index', 'fa fa-bar-chart', 1, 0, 0, 0),
	(21, 32, '清楚缓存', '/admin/permit/flushCache', '', 1, 0, 1, 1),
	(28, 0, '系统设置', '', 'fa fa-cogs', 1, 1, 0, 1),
	(29, 28, '用户管理', '/admin/user/list', 'fa  fa-user', 1, 0, 0, 1),
	(30, 28, '角色管理', '/admin/role/list', 'fa  fa-opencart', 1, 2, 0, 1),
	(31, 28, '导航管理', '/admin/nav/list', 'fa fa-navicon', 1, 0, 0, 1),
	(32, 28, '权限管理', '/admin/permit/list', 'fa fa-balance-scale', 1, 1, 0, 1),
	(43, 32, '添加子权限', '/admin/permit/add', '', 1, 0, 1, 1),
	(46, 32, '编辑权限', '/admin/permit/edit', '', 1, 0, 1, 1);
INSERT INTO `dya_nav` (`id`, `pid`, `name`, `link`, `icon`, `display`, `sort`, `type`, `sys`) VALUES
	(47, 32, '删除权限', '/admin/permit/del', '', 1, 0, 1, 1),
	(48, 31, '创建导航', '/admin/nav/add', '', 1, 0, 1, 1),
	(49, 31, '编辑导航', '/admin/nav/edit', '', 1, 0, 1, 1),
	(50, 31, '删除导航', '/admin/nav/del', '', 1, 0, 1, 1),
	(51, 31, '编辑导航排序', '/admin/nav/upsort', '', 1, 0, 1, 1),
	(52, 30, '创建角色', '/admin/role/add', '', 1, 0, 1, 1),
	(53, 30, '编辑角色', '/admin/role/edit', '', 1, 0, 1, 1),
	(54, 30, '删除角色', '/admin/role/del', '', 1, 0, 1, 1),
	(55, 29, '创建用户', '/admin/user/add', '', 1, 0, 1, 1),
	(56, 29, '编辑用户', '/admin/user/edit', '', 1, 0, 1, 1),
	(57, 29, '删除用户', '/admin/user/del', '', 1, 0, 1, 1),
	(58, 0, '工作流', '', 'fa fa-sitemap', 1, 0, 0, 0);
INSERT INTO `dya_nav` (`id`, `pid`, `name`, `link`, `icon`, `display`, `sort`, `type`, `sys`) VALUES
	(59, 58, '流程管理', '/workflow/manage/list', 'fa  fa-list-alt', 1, 0, 0, 0),
	(60, 58, '任务列表', '/workflow/task/list', 'fa fa-tasks', 1, 0, 0, 0),
	(61, 60, '发起新任务', '/workflow/task/flowList', '', 1, 0, 1, 0),
	(62, 60, '查看任务详情', '/workflow/task/view', '', 1, 0, 1, 0),
	(63, 60, '终止重启任务', '/workflow/task/stop', '', 1, 0, 1, 0),
	(64, 61, '创建新任务提交', '/workflow/task/add', '', 1, 0, 1, 0),
	(65, 62, '任务操作提交', '/workflow/task/flowOp', '', 1, 0, 1, 0),
	(66, 59, '工作流编辑', '/workflow/manage/edit', '', 1, 0, 1, 0),
	(67, 59, '禁用启用工作流', '/workflow/manage/stop', '', 1, 0, 1, 0),
	(68, 59, '创建工作流', '/workflow/manage/add', '', 1, 0, 1, 0),
	(69, 29, '用户修改个人信息', '/admin/user/userEdit', '', 1, 0, 1, 0);

-- 导出  表 dyadmin.dya_role 结构
CREATE TABLE IF NOT EXISTS `dya_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '角色名称',
  `permission` text COMMENT '权限集合(由nav id组成) ',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为正常  0为禁用',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- 正在导出表  dyadmin.dya_role 的数据：~3 rows (大约)
INSERT INTO `dya_role` (`id`, `name`, `permission`, `status`, `create_time`) VALUES
	(1, '管理员', '20,19,66,67,68,59,64,61,65,62,63,60,58,55,56,57,29,48,49,50,51,31,21,43,46,47,32,52,53,54,30,28,69', 1, '2016-09-30 10:23:12'),
	(2, '编辑', '20,19', 0, '2016-09-30 10:25:30'),
	(3, '运营', '20,19', 1, '2016-09-30 10:27:19');

-- 导出  表 dyadmin.wf_flow 结构
CREATE TABLE IF NOT EXISTS `wf_flow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建者id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '创建者realname',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为正常  1为禁用',
  `used` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已被使用  0未被使用',
  `explain` text NOT NULL COMMENT '说明',
  `flow` text NOT NULL COMMENT '流程json数据',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='工作流表';

-- 正在导出表  dyadmin.wf_flow 的数据：4 rows
/*!40000 ALTER TABLE `wf_flow` DISABLE KEYS */;
INSERT INTO `wf_flow` (`id`, `name`, `userid`, `username`, `status`, `used`, `explain`, `flow`, `create_time`) VALUES
	(8, 'ssss', 1, '管理员', 0, 1, 'ssssss', '{"title":"ssss","nodes":{"start_node":{"name":"开始","left":200,"top":134,"type":"start round mix","width":26,"height":26,"alt":true},"end_node":{"name":"结束","left":1000,"top":142,"type":"end round mix","width":26,"height":26,"alt":true},"1502183163062":{"name":"1111 <hr>Users:管理员 测试 ","left":321,"top":138,"type":"task","userIds":["1","4"],"mychsub":true,"width":160,"height":61,"alt":true},"1502183176602":{"name":"2222 <hr>Users:管理员 测试 ","left":600,"top":150,"type":"task","userIds":["1","4"],"mychsub":true,"width":165,"height":26,"alt":true}},"lines":{"1502183197464":{"type":"sl","from":"start_node","to":"1502183163062","name":""},"1502183199212":{"type":"sl","from":"1502183163062","to":"1502183176602","name":"1to2"},"1502183200706":{"type":"sl","from":"1502183176602","to":"end_node","name":""}},"areas":{},"initNum":10}', '2017-07-25 13:36:10');
INSERT INTO `wf_flow` (`id`, `name`, `userid`, `username`, `status`, `used`, `explain`, `flow`, `create_time`) VALUES
	(5, 'testflow', 1, '管理员', 1, 0, 'testflow  说明', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":""},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":{},"initNum":12}', '2017-06-27 14:00:52');
INSERT INTO `wf_flow` (`id`, `name`, `userid`, `username`, `status`, `used`, `explain`, `flow`, `create_time`) VALUES
	(6, 'testflow', 1, '管理员', 1, 1, 'testflow  说明', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":""},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":{},"initNum":12}', '2017-07-03 17:30:14');
INSERT INTO `wf_flow` (`id`, `name`, `userid`, `username`, `status`, `used`, `explain`, `flow`, `create_time`) VALUES
	(7, 'testflowwwwwwaaa', 1, '管理员', 0, 1, 'testflow  说明aaaaaabbbbbbbbbb', '{"title":"testflowwwwwwaaa","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":""},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":{},"initNum":12}', '2017-07-03 17:30:34');
/*!40000 ALTER TABLE `wf_flow` ENABLE KEYS */;

-- 导出  表 dyadmin.wf_task 结构
CREATE TABLE IF NOT EXISTS `wf_task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '流程id',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建者id',
  `name` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '创建者realname',
  `explain` text NOT NULL COMMENT '说明',
  `flow` text NOT NULL COMMENT '流程json数据',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为正常  1为终止 2为结束',
  `priority` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `node_users` varchar(50) NOT NULL COMMENT '所有节点涉及到的用户',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `node_users` (`node_users`),
  KEY `status` (`status`),
  KEY `priority` (`priority`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='任务表';

-- 正在导出表  dyadmin.wf_task 的数据：13 rows
/*!40000 ALTER TABLE `wf_task` DISABLE KEYS */;
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(19, 0, 1, 'swqqe', '管理员', '', '{"title":"testflow","nodes":{"start_node":{"name":"u5f00u59cb","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"u7ed3u675f","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:u7ba1u7406u5458 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:u6d4bu8bd5 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:u7ba1u7406u5458 u6d4bu8bd5 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 0, 0, ',1,4,', '2017-06-28 15:59:28');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(20, 0, 1, 'swqqe', '管理员', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":true,"marked":true},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":false},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false,"marked":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false,"marked":true}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"eeeeeessssssss","alt":true,"marked":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true,"marked":true}},"areas":[],"initNum":10}', 2, 0, ',1,4,', '2017-06-28 16:02:32');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(21, 5, 1, '震要3', '管理员', 'sss3', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 3, ',1,4,', '2017-06-29 20:11:20');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(22, 5, 1, '震要要伯', '管理员', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":false},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":true,"marked":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true,"marked":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,', '2017-06-29 20:17:04');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(35, 8, 1, '222222', '管理员', '222222', '{"title":"ssss","nodes":{"start_node":{"name":"开始","left":200,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":1000,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1502183163062":{"name":"1111 <hr>Users:管理员 测试 ","left":321,"top":138,"type":"task","userIds":["1","4"],"mychsub":true,"width":160,"height":61,"alt":true,"marked":true,"current":false},"1502183176602":{"name":"2222 <hr>Users:管理员 测试 ","left":600,"top":150,"type":"task","userIds":["1","4"],"mychsub":true,"width":165,"height":26,"alt":true,"current":true,"marked":true}},"lines":{"1502183197464":{"type":"sl","from":"start_node","to":"1502183163062","name":"","marked":true},"1502183199212":{"type":"sl","from":"1502183163062","to":"1502183176602","name":"1to2","marked":true},"1502183200706":{"type":"sl","from":"1502183176602","to":"end_node","name":""}},"areas":[],"initNum":10}', 0, 2222, ',1,4,', '2017-08-08 17:12:24');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(34, 8, 1, '111', '管理员', '11111', '{"title":"ssss","nodes":{"start_node":{"name":"开始","left":200,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":1000,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1502183163062":{"name":"1111 <hr>Users:测试 ","left":365,"top":141,"type":"task","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1502183176602":{"name":"2222 <hr>Users:管理员 测试 ","left":600,"top":150,"type":"task","userIds":["1","4"],"mychsub":true,"width":165,"height":26,"alt":true,"current":false}},"lines":{"1502183197464":{"type":"sl","from":"start_node","to":"1502183163062","name":"","alt":true,"marked":true},"1502183199212":{"type":"sl","from":"1502183163062","to":"1502183176602","name":"1to2","alt":true},"1502183200706":{"type":"sl","from":"1502183176602","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 0, 111, ',4,1,', '2017-08-08 17:07:23');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(25, 0, 1, 'swqqe', '管理员', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,', '2017-06-29 20:19:38');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(26, 5, 1, '震要要伯有工56789', '管理员', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,', '2017-06-29 20:20:03');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(33, 7, 1, '1111111111111', '管理员', '11111111111111111', '{"title":"testflowwwwwwaaa","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":[],"initNum":12}', 0, 11, ',1,4,', '2017-07-25 13:35:25');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(28, 5, 1, 'werewrwrw', '管理员', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,', '2017-06-30 17:29:40');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(32, 7, 1, 'weee要', '管理员', 'a鼎折覆餗困地', '{"title":"testflowwwwwwaaa","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true,"marked":true,"current":false},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true,"current":true,"marked":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","marked":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":[],"initNum":12}', 0, 33337897, ',1,4,', '2017-07-17 18:42:11');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(30, 6, 1, 'task123', '管理员', 'task123456', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":[],"initNum":12}', 1, 112, ',1,4,', '2017-07-04 14:21:40');
INSERT INTO `wf_task` (`id`, `fid`, `userid`, `name`, `username`, `explain`, `flow`, `status`, `priority`, `node_users`, `create_time`) VALUES
	(31, 6, 1, 'qwfesdfadsfadsf', '管理员', 'sfaaaaaaaaaaaaaaaaaaaaaaa', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":[],"initNum":12}', 0, 113, ',1,4,', '2017-07-04 14:32:51');
/*!40000 ALTER TABLE `wf_task` ENABLE KEYS */;

-- 导出  表 dyadmin.wf_task_log 结构
CREATE TABLE IF NOT EXISTS `wf_task_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务id',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作者id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '操作者realname',
  `line_name` varchar(50) NOT NULL DEFAULT '' COMMENT '操作名',
  `operate` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0创建任务，1流程操作，2追加备注, 3任务结束，4任务终止，5任务重启,6任务修改',
  `remark` text NOT NULL COMMENT '备注信息',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='任务操作记录';

-- 正在导出表  dyadmin.wf_task_log 的数据：41 rows
/*!40000 ALTER TABLE `wf_task_log` DISABLE KEYS */;
INSERT INTO `wf_task_log` (`id`, `tid`, `userid`, `username`, `line_name`, `operate`, `remark`, `create_time`) VALUES
	(1, 20, 1, '管理员', '', 0, '坐在林', '2017-06-29 18:56:14'),
	(2, 20, 1, '管理员', '', 1, '受伤的女人有', '2017-06-29 18:58:25'),
	(3, 20, 1, '管理员', '', 2, '受伤的女人有', '2017-06-29 19:04:01'),
	(4, 20, 1, '管理员', '', 3, '受伤的女人有', '2017-06-29 19:04:53'),
	(5, 20, 1, '管理员', '', 4, '受伤的女人有', '2017-06-29 19:06:01'),
	(6, 20, 1, '管理员', '', 5, '受伤的女人有', '2017-06-29 19:06:18'),
	(7, 20, 1, '管理员', '', 2, '受伤的女人有', '2017-06-29 19:07:18'),
	(8, 20, 1, '管理员', '', 2, 'sdfdsfdsfds', '2017-06-29 19:13:08'),
	(13, 22, 1, '管理员', '', 1, 'ds', '2017-07-04 16:13:49'),
	(14, 22, 1, '管理员', '', 1, 'ds', '2017-07-04 16:13:58'),
	(15, 22, 1, '管理员', '', 1, 'ds', '2017-07-04 16:18:21');
INSERT INTO `wf_task_log` (`id`, `tid`, `userid`, `username`, `line_name`, `operate`, `remark`, `create_time`) VALUES
	(16, 22, 1, '管理员', '', 1, 'ds', '2017-07-04 16:21:14'),
	(17, 22, 1, '管理员', '', 1, 'ds', '2017-07-04 16:33:23'),
	(18, 22, 1, '管理员', '', 2, 'dffgdfgdgsdgsgf', '2017-07-04 16:35:31'),
	(19, 22, 1, '管理员', '', 2, 'dffgdfgdgsdgsgf', '2017-07-04 16:36:45'),
	(20, 20, 1, '管理员', '', 2, 'wlkfjadsl;fj;das', '2017-07-04 16:48:14'),
	(9, 20, 1, '管理员', '', 1, '完成', '2017-06-29 19:21:17'),
	(10, 20, 1, '管理员', '', 2, '鼎折覆餗', '2017-06-29 19:34:01'),
	(11, 22, 1, '管理员', '', 5, '工作流重启', '2017-07-04 15:56:38'),
	(12, 22, 1, '管理员', '', 4, '工作流终止', '2017-07-04 15:56:58');
INSERT INTO `wf_task_log` (`id`, `tid`, `userid`, `username`, `line_name`, `operate`, `remark`, `create_time`) VALUES
	(21, 20, 1, '管理员', '', 2, 'sd<em>faf</em>afafasfa<span style="color:#E53333;">][]fwfskl</span>afjqpwf<strong>jdfasfw<span style="font-size:32px;">erewqfasfadfafdaf</span></strong>', '2017-07-04 16:49:30'),
	(22, 21, 1, '管理员', '', 0, '任务修改: 管理员 修改了任务', '2017-07-06 18:21:16'),
	(23, 21, 1, '管理员', '', 0, '任务修改: 管理员 修改了任务', '2017-07-06 18:21:24'),
	(24, 21, 1, '管理员', '', 0, '任务修改: 管理员 修改了任务', '2017-07-06 18:23:17'),
	(25, 21, 1, '管理员', '', 0, '任务修改: 管理员 修改了任务', '2017-07-06 18:45:15'),
	(26, 21, 1, '管理员', '', 0, '任务修改: 管理员 修改了任务<br />流程名称: 震要 -> 震要3<br />说明: sss -> sss3<br />优先级: 2 -> 3', '2017-07-06 18:49:02');
INSERT INTO `wf_task_log` (`id`, `tid`, `userid`, `username`, `line_name`, `operate`, `remark`, `create_time`) VALUES
	(27, 32, 1, '管理员', '', 0, '任务开始: 管理员 创建了任务', '2017-07-17 18:42:11'),
	(28, 33, 1, '管理员', '', 0, '任务开始: 管理员 创建了任务', '2017-07-25 13:35:26'),
	(29, 32, 1, '管理员', '', 6, '任务修改: 管理员 修改了任务<br />流程名称: weee -> weee要', '2017-08-08 16:24:44'),
	(30, 34, 1, '管理员', '', 0, '任务开始: 管理员 创建了任务', '2017-08-08 17:07:23'),
	(31, 35, 1, '管理员', '', 0, '任务开始: 管理员 创建了任务', '2017-08-08 17:12:24'),
	(32, 35, 1, '管理员', '1to2', 1, 'asfsafafasfdsafwfwfssaa', '2017-08-08 17:13:13'),
	(33, 32, 1, '管理员', '', 4, '工作流终止', '2018-03-23 13:44:43'),
	(34, 32, 1, '管理员', '', 5, '工作流重启', '2018-03-23 13:44:51');
INSERT INTO `wf_task_log` (`id`, `tid`, `userid`, `username`, `line_name`, `operate`, `remark`, `create_time`) VALUES
	(35, 32, 1, '管理员', '', 1, 'dfgadfadfa', '2018-07-25 11:50:26'),
	(36, 32, 1, '管理员', '', 1, 'dfgadfadfa', '2018-07-25 11:50:40'),
	(37, 32, 1, '管理员', '', 2, 'werwe', '2018-07-25 11:51:06'),
	(38, 32, 1, '管理员', '', 6, '任务修改: 管理员 修改了任务<br />优先级: 3333 -> 3333789', '2019-01-07 18:20:25'),
	(39, 32, 1, '管理员', '', 6, '任务修改: 管理员 修改了任务<br />优先级: 3333789 -> 33337897', '2019-01-07 18:20:39'),
	(40, 32, 1, '管理员', '', 2, '受信托人脑挫伤伴硬脑膜外血肿斧', '2020-04-05 15:05:06'),
	(41, 32, 1, '管理员', '', 2, '受信托人脑挫伤伴硬脑膜外血肿斧', '2020-04-05 15:05:12');
/*!40000 ALTER TABLE `wf_task_log` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
