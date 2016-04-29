<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/site_define.php');
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

        <title><?php echo BLOGNAME; ?>-管理-更新</title>
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
<div id='update'>
    <div class='notice'>
<?php
if ($_POST['title'] == '' || ($_POST['class'] == 'select_class' && $_POST['new_class'] == ''))
{
    echo "<p>填写不完整！使用浏览器后退。</p>\n";
}
else
{
    $item = str_replace("\r\n", "\n", $_POST['item']);

    if ($_POST['new_class'] != '')
    {
        $class = $_POST['new_class'];
    }
    else
    {
        $class = $_POST['class'];
    }

    $sql = sprintf("UPDATE `article` SET `done` = '%s', `class` = '%s', `title` = '%s', `item` = '%s', `deadline` = '%s' WHERE `id` = '%s'",
        mysqli_real_escape_string($connection, $_POST['done']),
        mysqli_real_escape_string($connection, $class),
        mysqli_real_escape_string($connection, $_POST['title']),
        mysqli_real_escape_string($connection, $item),
        mysqli_real_escape_string($connection, $_POST['deadline']),
        mysqli_real_escape_string($connection, $_POST['id']));

    $result = mysqli_query($connection, $sql);
    if ($result == FALSE)
    {
        echo 'cannot query';
    }

    echo "<p>已更新！</p>\n";
    echo "<a href='article.php?id=" . $_POST['id'] . "'>查看文章</a>\n";
    echo "<a href='article_list.php'>返回文章列表</a>\n";
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
