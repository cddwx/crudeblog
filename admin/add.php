<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/sql_define.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/sql_connect.php');
?>
<?php
session_start();

if ($_SESSION['authenticated'] != '1')
{
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w4.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Language" content="zh-cn" />

        <link rel="stylesheet" type="text/css" href="/css/1.css" />

        <title>万重山-管理-添加</title>
    </head>
    <body>
        <div id='container'>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/header_admin.php');
?>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/side_admin.php');
?>

<!--主体开始-->
            <div id='main' class='container_div'>
                <div id='main_content' class='normal_div'>
<div id='add'>
    <div class='notice'>
<?php
if ($_POST['title'] == '' || ($_POST['class'] == 'select_class' && $_POST['new_class'] == ''))
{
    echo "<p>填写不完整！使用浏览器后退。</p>\n";
}
else
{
    $item = str_replace("\r\n", "\n", $_POST['item']);
    $date = date("Y-m-d");
    $time = date("H:i:s");

    if ($_POST['new_class'] != '')
    {
        $class = $_POST['new_class'];
    }
    else
    {
        $class = $_POST['class'];
    }

    $sql = sprintf("INSERT INTO `article`
            (`done`, `class`, `title`, `item`, `date`, `time`, `deadline`)
            VALUES
            ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            mysqli_real_escape_string($connection, $_POST['done']),
            mysqli_real_escape_string($connection, $class),
            mysqli_real_escape_string($connection, $_POST['title']),
            mysqli_real_escape_string($connection, $item),
            mysqli_real_escape_string($connection, $date),
            mysqli_real_escape_string($connection, $time),
            mysqli_real_escape_string($connection, $_POST['deadline']));

    $result = mysqli_query($connection, $sql);
    if ($result == FALSE)
    {
        echo 'cannot query';
        exit();
    }
    else
    {
        $id = mysqli_insert_id($connection);

        echo "<p>已添加！</p>\n";
        echo "<a href='article.php?id=" . $id . "'>查看文章</a>\n";
        echo "<a href='article_list.php'>返回文章列表</a>\n";
    }
}
?>
    </div>
</div>
                </div>
            </div>
<!--主体结束-->

<!--清除浮动-->
<div class='clear'></div>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php');
?>
        </div>
    </body>
</html>
