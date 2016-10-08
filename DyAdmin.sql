-- --------------------------------------------------------
-- 主机:                           172.66.60.191
-- 服务器版本:                        5.1.73 - Source distribution
-- 服务器操作系统:                      redhat-linux-gnu
-- HeidiSQL 版本:                  9.3.0.5114
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 dyadmin 的数据库结构
CREATE DATABASE IF NOT EXISTS `dyadmin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dyadmin`;

-- 导出  表 dyadmin.member 结构
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `role_ids` tinytext COMMENT '用户对应的角色id集合',
  `create_time` datetime NOT NULL COMMENT '用户加入时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为正常  0为禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- 正在导出表  dyadmin.member 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`id`, `username`, `password`, `role_ids`, `create_time`, `status`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '0000-00-00 00:00:00', 1),
	(4, 'test', 'e10adc3949ba59abbe56e057f20f883e', '1,4', '2016-10-06 10:13:19', 1);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

-- 导出  表 dyadmin.nav 结构
CREATE TABLE IF NOT EXISTS `nav` (
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='导航与权限统一使用此表';

-- 正在导出表  dyadmin.nav 的数据：~20 rows (大约)
/*!40000 ALTER TABLE `nav` DISABLE KEYS */;
INSERT INTO `nav` (`id`, `pid`, `name`, `link`, `icon`, `display`, `sort`, `type`, `sys`) VALUES
	(19, 0, '看板视图', '', 'fa fa-dashboard', 1, 0, 0, 0),
	(20, 19, '系统看板', '/admin/home/index', 'fa fa-bar-chart', 1, 0, 0, 0),
	(28, 0, '系统设置', '', 'fa fa-cogs', 1, 1, 0, 1),
	(29, 28, '用户管理', '/admin/user/list', 'fa  fa-user', 1, 3, 0, 1),
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
	(57, 29, '删除用户', '/admin/user/del', '', 1, 0, 1, 1);
/*!40000 ALTER TABLE `nav` ENABLE KEYS */;

-- 导出  表 dyadmin.role 结构
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '角色名称',
  `permission` text COMMENT '权限集合(由nav id组成) ',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为正常  0为禁用',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- 正在导出表  dyadmin.role 的数据：~4 rows (大约)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `permission`, `status`, `create_time`) VALUES
	(1, '管理员', '20,19,49,50,31,43,46,47,32,52,53,54,30,55,56,57,29,28', 1, '2016-09-30 10:23:12'),
	(2, '编辑', '20,19', 0, '2016-09-30 10:25:30'),
	(3, '运营', '20,19', 0, '2016-09-30 10:27:19'),
	(4, '技术', '20,19', 1, '2016-09-30 10:30:11');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
