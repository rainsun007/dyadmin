DYA(DyAdmin)是一个基于角色的管理后台系统

此系统基于 [dyphpframework](https://github.com/rainsun007/dyphpframework) 开发

UI使用了[AdminLTE](https://github.com/almasaeed2010/AdminLTE/)


> - 使用前需要修改/application/config/config.php文件中的数据库配制信息
> - DyAdmin.sql为数据结构文件
> - 管理员默认用户名:admin , 密码:123456


多项目时注意以下文件冲突问题
- /index.php
- /application/config/config.php
- /application/controller/AppController.php