<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/site_define.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/sql_connect.php');
?>
<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w4.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Language" content="zh-cn" />
        <link rel="stylesheet" type="text/css" href="/css/1.css" />

        <title><?php echo BLOGNAME; ?>-管理-登出</title>
    </head>
    <body>
        <div class='notice'>
<?php
if ($_SESSION['authenticated'] != '1')
{
    echo "<p>未登录！</p>\n";
}
else
{
    session_unset();
    session_destroy();

    echo "<p>已登出！</p>\n";
    //echo "[" . $_SESSION['authenticated'] . "]";
    echo "<a href='/index.php'>首页</a>\n";
}
?>
        </div>
    </body>
</html>
