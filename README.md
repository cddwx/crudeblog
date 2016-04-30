# crudeblog
A very simple and straightforward blog system written in PHP.

## 目录结构

    admin/
     \_ add.php
     \_ article.php
     \_ article_list.php
     \_ comment.php
     \_ delete.php
     \_ delete_confirm.php
     \_ index.php
     \_ login.php
     \_ logout.php
     \_ update.php
     \_ write.php
     
    css/
     \_ 1.css
     
    include/
     \_ .htaccess
     \_ footer.php
     \_ header.php
     \_ header_admin.php
     \_ side.php
     \_ side_admin.php
     \_ site_define.php
     \_ sql_connect.php
     \_ sql_result_array.php

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
表 'article'

    CREATE TABLE IF NOT EXISTS `article` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `done` tinyint(1) DEFAULT NULL,
        `class` tinyblob,
        `title` tinyblob,
        `item` blob,
        `date` date DEFAULT NULL,
        `time` time DEFAULT NULL,
        `deadline` date DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

表 'comment'

    CREATE TABLE IF NOT EXISTS `comment` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `parent_id` int(10) unsigned DEFAULT NULL,
        `article_id` int(10) unsigned DEFAULT NULL,
        `user` tinytext,
        `email` tinytext,
        `website` tinytext,
        `date` date DEFAULT NULL,
        `time` time DEFAULT NULL,
        `content` text,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
