-- --------------------------------------------------------
-- 主机:                           172.66.60.191
-- 服务器版本:                        5.1.73 - Source distribution
-- 服务器操作系统:                      redhat-linux-gnu
-- HeidiSQL 版本:                  9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  表 dyadmin.dya_member 结构
CREATE TABLE IF NOT EXISTS `dya_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `realname` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `password` varchar(50) NOT NULL DEFAULT '',
  `role_ids` tinytext COMMENT '用户对应的角色id集合',
  `create_time` datetime NOT NULL COMMENT '用户加入时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为正常  0为禁用',
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- 正在导出表  dyadmin.dya_member 的数据：~4 rows (大约)
/*!40000 ALTER TABLE `dya_member` DISABLE KEYS */;
INSERT INTO `dya_member` (`id`, `username`, `realname`, `password`, `role_ids`, `create_time`, `status`, `email`) VALUES
	(1, 'admin', '管理员', 'e10adc3949ba59abbe56e057f20f883e', '1', '0000-00-00 00:00:00', 1, 'rain@test.com'),
	(4, 'demouser', '测试', 'e10adc3949ba59abbe56e057f20f883e', '3', '2016-10-06 10:13:19', 1, 'ssssss@test.com'),
	(5, 'test1', '测试2', 'e10adc3949ba59abbe56e057f20f883e', '3', '2017-05-09 14:07:22', 0, 'qqqqq@test.com'),
	(6, 'demouser2', '测试号', 'e10adc3949ba59abbe56e057f20f883e', '3', '2017-06-23 14:59:58', 0, 'sssssssss@163.com');
/*!40000 ALTER TABLE `dya_member` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COMMENT='导航与权限统一使用此表';

-- 正在导出表  dyadmin.dya_nav 的数据：~25 rows (大约)
/*!40000 ALTER TABLE `dya_nav` DISABLE KEYS */;
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
	(46, 32, '编辑权限', '/admin/permit/edit', '', 1, 0, 1, 1),
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
	(58, 0, '工作流', '', 'fa fa-sitemap', 1, 0, 0, 0),
	(59, 58, '工作流管理', '/workflow/manage/list', 'fa  fa-list-alt', 1, 0, 0, 0),
	(60, 58, '任务列表', '/workflow/task/list', 'fa fa-tasks', 1, 0, 0, 0),
	(61, 60, '发起新任务', '/workflow/task/flowList', '', 1, 0, 1, 0),
	(62, 60, '查看任务详情', '/workflow/task/view', '', 1, 0, 1, 0),
	(63, 60, '终止重启任务', '/workflow/task/stop', '', 1, 0, 1, 0),
	(64, 61, '创建新任务提交', '/workflow/task/add', '', 1, 0, 1, 0),
	(65, 62, '任务操作提交', '/workflow/task/flowOp', '', 1, 0, 1, 0),
	(66, 59, '工作流编辑', '/workflow/manage/edit', '', 1, 0, 1, 0),
	(67, 59, '禁用启用工作流', '/workflow/manage/stop', '', 1, 0, 1, 0),
	(68, 59, '创建工作流', '/workflow/manage/add', '', 1, 0, 1, 0);
/*!40000 ALTER TABLE `dya_nav` ENABLE KEYS */;

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
/*!40000 ALTER TABLE `dya_role` DISABLE KEYS */;
INSERT INTO `dya_role` (`id`, `name`, `permission`, `status`, `create_time`) VALUES
	(1, '管理员', '20,19,49,50,31,43,46,47,32,52,53,54,30,55,56,57,29,28,21,48,51', 1, '2016-09-30 10:23:12'),
	(2, '编辑', '20,19', 0, '2016-09-30 10:25:30'),
	(3, '运营', '20,19', 1, '2016-09-30 10:27:19');
/*!40000 ALTER TABLE `dya_role` ENABLE KEYS */;

-- 导出  表 dyadmin.wf_flow 结构
CREATE TABLE IF NOT EXISTS `wf_flow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建者id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '创建者realname',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为正常  1为禁用',
  `used` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已被使用  0未被使用',
  `explain` text NOT NULL COMMENT '说明',
  `flow` text NOT NULL COMMENT '流程json数据',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='工作流表';

-- 正在导出表  dyadmin.wf_flow 的数据：7 rows
/*!40000 ALTER TABLE `wf_flow` DISABLE KEYS */;
INSERT INTO `wf_flow` (`id`, `name`, `userid`, `username`, `create_time`, `status`, `used`, `explain`, `flow`) VALUES
	(5, 'testflow', 1, '管理员', '2017-06-27 14:00:52', 1, 0, 'testflow  说明', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":""},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":{},"initNum":12}'),
	(6, 'testflow', 1, '管理员', '2017-07-03 17:30:14', 1, 1, 'testflow  说明', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":""},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":{},"initNum":12}'),
	(7, 'testflowwwwwwaaa', 1, '管理员', '2017-07-03 17:30:34', 0, 0, 'testflow  说明aaaaaaaaaaaaaaaa', '{"title":"testflowwwwwwaaa","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":""},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":{},"initNum":12}');
/*!40000 ALTER TABLE `wf_flow` ENABLE KEYS */;

-- 导出  表 dyadmin.wf_task 结构
CREATE TABLE IF NOT EXISTS `wf_task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '流程id',
  `name` varchar(50) NOT NULL DEFAULT '',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建者id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '创建者realname',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `explain` text NOT NULL COMMENT '说明',
  `flow` text NOT NULL COMMENT '流程json数据',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为正常  1为终止 2为结束',
  `priority` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '优先级',
  `node_users` varchar(50) NOT NULL COMMENT '所有节点涉及到的用户',
  PRIMARY KEY (`id`),
  KEY `node_users` (`node_users`),
  KEY `status` (`status`),
  KEY `priority` (`priority`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='任务表';

-- 正在导出表  dyadmin.wf_task 的数据：31 rows
/*!40000 ALTER TABLE `wf_task` DISABLE KEYS */;
INSERT INTO `wf_task` (`id`, `fid`, `name`, `userid`, `username`, `create_time`, `explain`, `flow`, `status`, `priority`, `node_users`) VALUES
	(19, 0, 'swqqe', 1, '管理员', '2017-06-28 15:59:28', '', '{"title":"testflow","nodes":{"start_node":{"name":"u5f00u59cb","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"u7ed3u675f","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:u7ba1u7406u5458 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:u6d4bu8bd5 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:u7ba1u7406u5458 u6d4bu8bd5 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 0, 0, ',1,4,'),
	(20, 0, 'swqqe', 1, '管理员', '2017-06-28 16:02:32', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":true,"marked":true},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":false},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false,"marked":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false,"marked":true}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"eeeeeessssssss","alt":true,"marked":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true,"marked":true}},"areas":[],"initNum":10}', 2, 0, ',1,4,'),
	(21, 5, '震要', 1, '管理员', '2017-06-29 20:11:20', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,'),
	(22, 5, '震要要伯', 1, '管理员', '2017-06-29 20:17:04', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":false},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":true,"marked":true},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true,"marked":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,'),
	(25, 0, 'swqqe', 1, '管理员', '2017-06-29 20:19:38', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,'),
	(26, 5, '震要要伯有工56789', 1, '管理员', '2017-06-29 20:20:03', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,'),
	(28, 5, 'werewrwrw', 1, '管理员', '2017-06-30 17:29:40', '', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":961,"top":142,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":297,"top":138,"type":"task","userIds":["1"],"mychsub":true,"width":104,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":519,"top":148,"type":"node","userIds":["4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":734,"top":172,"type":"chat","userIds":["1","4"],"mychsub":true,"width":104,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","alt":true,"marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":"","alt":true},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":"","alt":true},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":"","alt":true}},"areas":[],"initNum":10}', 1, 0, ',1,4,'),
	(30, 6, 'task123', 1, '管理员', '2017-07-04 14:21:40', 'task123456', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":[],"initNum":12}', 1, 112, ',1,4,'),
	(31, 6, 'qwfesdfadsfadsf', 1, '管理员', '2017-07-04 14:32:51', 'sfaaaaaaaaaaaaaaaaaaaaaaa', '{"title":"testflow","nodes":{"start_node":{"name":"开始","left":139,"top":134,"type":"start round mix","width":26,"height":26,"alt":true,"marked":true,"current":false},"end_node":{"name":"结束","left":1046,"top":156,"type":"end round mix","width":26,"height":26,"alt":true,"current":false},"1498543220047":{"name":"ss <hr>Users:管理员 ","left":311,"top":124,"type":"task","userIds":["1"],"mychsub":true,"width":138,"height":26,"alt":true,"marked":true,"current":true},"1498543228414":{"name":"ee <hr>Users:测试 ","left":514,"top":143,"type":"node","userIds":["4"],"mychsub":true,"width":143,"height":26,"alt":true,"current":false},"1498543236122":{"name":"ssee <hr>Users:管理员 测试 ","left":732,"top":142,"type":"chat","userIds":["1","4"],"mychsub":true,"width":197,"height":26,"alt":true,"current":false}},"lines":{"1498543245810":{"type":"sl","from":"start_node","to":"1498543220047","name":"","marked":true},"1498543246911":{"type":"sl","from":"1498543220047","to":"1498543228414","name":""},"1498543247821":{"type":"sl","from":"1498543228414","to":"1498543236122","name":""},"1498543249443":{"type":"sl","from":"1498543236122","to":"end_node","name":""},"1499073717022":{"type":"tb","M":30.5,"from":"1498543228414","to":"1498543220047","name":""}},"areas":[],"initNum":12}', 0, 113, ',1,4,');
/*!40000 ALTER TABLE `wf_task` ENABLE KEYS */;

-- 导出  表 dyadmin.wf_task_log 结构
CREATE TABLE IF NOT EXISTS `wf_task_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务id',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作者id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '操作者realname',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `operate` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0创建任务，1流程操作，2追加备注, 3任务结束，4任务终止，5任务重启',
  `remark` text NOT NULL COMMENT '备注信息',
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='任务操作记录';

-- 正在导出表  dyadmin.wf_task_log 的数据：10 rows
/*!40000 ALTER TABLE `wf_task_log` DISABLE KEYS */;
INSERT INTO `wf_task_log` (`id`, `tid`, `userid`, `username`, `create_time`, `operate`, `remark`) VALUES
	(1, 20, 1, '管理员', '2017-06-29 18:56:14', 0, '坐在林'),
	(2, 20, 1, '管理员', '2017-06-29 18:58:25', 1, '受伤的女人有'),
	(3, 20, 1, '管理员', '2017-06-29 19:04:01', 2, '受伤的女人有'),
	(4, 20, 1, '管理员', '2017-06-29 19:04:53', 3, '受伤的女人有'),
	(5, 20, 1, '管理员', '2017-06-29 19:06:01', 4, '受伤的女人有'),
	(6, 20, 1, '管理员', '2017-06-29 19:06:18', 5, '受伤的女人有'),
	(7, 20, 1, '管理员', '2017-06-29 19:07:18', 2, '受伤的女人有'),
	(8, 20, 1, '管理员', '2017-06-29 19:13:08', 2, 'sdfdsfdsfds'),
	(13, 22, 1, '管理员', '2017-07-04 16:13:49', 1, 'ds'),
	(14, 22, 1, '管理员', '2017-07-04 16:13:58', 1, 'ds'),
	(15, 22, 1, '管理员', '2017-07-04 16:18:21', 1, 'ds'),
	(16, 22, 1, '管理员', '2017-07-04 16:21:14', 1, 'ds'),
	(17, 22, 1, '管理员', '2017-07-04 16:33:23', 1, 'ds'),
	(18, 22, 1, '管理员', '2017-07-04 16:35:31', 2, 'dffgdfgdgsdgsgf'),
	(19, 22, 1, '管理员', '2017-07-04 16:36:45', 2, 'dffgdfgdgsdgsgf'),
	(20, 20, 1, '管理员', '2017-07-04 16:48:14', 2, 'wlkfjadsl;fj;das'),
	(9, 20, 1, '管理员', '2017-06-29 19:21:17', 1, '完成'),
	(10, 20, 1, '管理员', '2017-06-29 19:34:01', 2, '鼎折覆餗'),
	(11, 22, 1, '管理员', '2017-07-04 15:56:38', 5, '工作流重启'),
	(12, 22, 1, '管理员', '2017-07-04 15:56:58', 4, '工作流终止'),
	(21, 20, 1, '管理员', '2017-07-04 16:49:30', 2, 'sd<em>faf</em>afafasfa<span style="color:#E53333;">][]fwfskl</span>afjqpwf<strong>jdfasfw<span style="font-size:32px;">erewqfasfadfafdaf</span></strong>');
/*!40000 ALTER TABLE `wf_task_log` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
