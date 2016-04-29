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
<?php
if ($_GET['class'] != '')
{
    $class = htmlspecialchars($_GET['class']);
}
else
{
    $class = '全部';
}
?>
        <title>xxxx-管理-文章列表-<?php echo $class; ?></title>
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
<?php
if ($_GET['class'] != '')
{
    $class = htmlspecialchars($_GET['class']);
}
else
{
    $class = '全部';
}
?>

<div id='article_list'>
    <h1 id='class_name'><?php echo $class; ?></h1>
    <hr />

<?php
if ($_GET['class'] != '')
{
    $sql = sprintf('SELECT
            `id`, `done`, `class`, `title`, `date`, `time`, `deadline`
            FROM `article` WHERE `class` = "%s"
            ORDER BY `date` DESC, `time` DESC',
            mysqli_real_escape_string($connection, $_GET['class']));
}
else
{
    $sql = 'SELECT `id`, `done`, `class`, `title`, `date`, `time`, `deadline`
            FROM `article` ORDER BY `date` DESC, `time` DESC';
}

require($_SERVER['DOCUMENT_ROOT'] . '/include/sql_result_array.php');

$i = 1;
$ii = count($object);
for($i =1; $i <= $ii; $i = $i + 1)
{
    $id         = $object[$i]['id'];
    $done       = $object[$i]['done'];
    $class      = $object[$i]['class'];
    $title      = $object[$i]['title'];
    $item       = $object[$i]['item'];
    $date       = $object[$i]['date'];
    $time       = $object[$i]['time'];
    $deadline   = $object[$i]['deadline'];

    $title      = htmlspecialchars($title);
    $class      = htmlspecialchars($class);

    echo "<div class='article_entry'>\n";
    echo "\t<h2><a href='article.php?id=" . $id . "'>" . $title . "</a></h2>\n";
    echo "\t<div class='article_entry_infomation'>\n";

    echo "\t\t<span>完成:</span>\n";
    if ($done == '1')
    {
        echo "\t\t<span class='description'>[" . $done . "]</span>\n";
    }
    else
    {
        echo "\t\t<span class='red'>[" . $done . "]</span>\n";
    }

    echo "\t\t<span>截止日期:</span>\n";
    echo "\t\t<span class='description'>[" . $deadline . "]</span>\n";

    echo "\t\t<span>分类:</span>\n";
    echo "\t\t<span class='description'>" . $class . "</span>\n";

    echo "\t\t<span>时间:</span>\n";
    echo "\t\t<span class='description'>" . $date . " " . $time . "</span>\n";

    echo "\t\t<span>id:</span>\n";
    echo "\t\t<span class='description'>" . $id . "</span>\n";

    echo "\t\t<span><a href='export.php?id=" . $id . "'>导出</a></span>\n";

    echo "\t\t<span><a href='write.php?id=" . $id . "'>编辑</a></span>\n";

    echo "\t\t<span><a href='delete_confirm.php?id=" . $id . "'>删除</a></span>\n";

    echo "\t</div>\n";
    echo "</div>\n";
}

unset($object);
?>
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
