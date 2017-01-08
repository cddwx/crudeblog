# 简介
A very simple and straightforward blog system written in PHP.

## 设置
###主要设置
文件: include/site_define.php

    // 数据库信息
    define('HOST', '');
    define('USER', '');
    define('PASSWORD', '');
    define('DB', '');

    // 博客名, 默认为 'crudeblog'
    define('BLOGNAME', 'crudeblog');

    // 管理员帐号和密码, 不能使用空用户名或密码
    define('ADMIN', '');
    define('ADMIN_PASS', '');

### 自定义页脚
文件: include/footer.php


## 数据库结构
参照 DATABASE.sql 文件