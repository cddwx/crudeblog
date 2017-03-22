<?php
require $_SERVER['DOCUMENT_ROOT'] . "/include/site_define.php";
require $_SERVER['DOCUMENT_ROOT'] . "/include/sql_connect.php";
?>
<?php
session_start();

if ($_SESSION['authenticated'] != '1')
{
    header("Location: login.php");
    exit;
}
?>
<?php
$sql = sprintf("SELECT `title` FROM `article` WHERE `id` = '%s'",
        mysqli_real_escape_string($connection, $_POST['article_id']));

//echo 'hello';
require $_SERVER['DOCUMENT_ROOT'] . "/include/sql_result_array.php";

$id         = $object[1]['id'];
$done       = $object[1]['done'];
$class      = $object[1]['class'];
$title      = $object[1]['title'];
$item       = $object[1]['item'];
$date       = $object[1]['date'];
$time       = $object[1]['time'];
$deadline   = $object[1]['deadline'];

$title      = htmlspecialchars($title);

unset($object);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w4.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="zh-cn" />
<link rel="stylesheet" type="text/css" href="/css/1.css" />
<title><?php echo BLOGNAME; ?>-管理-文章-<?php echo $title; ?>-评论</title>
</head>
<body>
<div id='container'>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/include/header_admin.php";
?>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/include/side_admin.php";
?>

<!--主体开始-->
<div id='main' class='container_div'>
<div id='main_content' class='normal_div'>
<div id='comment'>
<div class='notice'>
<?php
//echo $_POST['user'];
//echo $_POST['content'];
if ($_POST['user'] == '' || $_POST['content'] == '' || $_POST['email'] == '')
{
    echo "<p>填写不完整！</p>\n";
    echo "<a href='article.php?id=" . $_POST['article_id'] . "'>查看文章</a>\n";
    echo "<a href='article_list.php'>返回文章列表</a>\n";
}
else
{
    $content = str_replace("\r\n", "\n", $_POST['content']);
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $sql = sprintf("INSERT INTO `comment`
            (`article_id`, `user`, `email`, `website`, `date`, `time`, `content`)
            VALUES
            ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            mysqli_real_escape_string($connection, $_POST['article_id']),
            mysqli_real_escape_string($connection, $_POST['user']),
            mysqli_real_escape_string($connection, $_POST['email']),
            mysqli_real_escape_string($connection, $_POST['website']),
            mysqli_real_escape_string($connection, $date),
            mysqli_real_escape_string($connection, $time),
            mysqli_real_escape_string($connection, $content));

    $result = mysqli_query($connection, $sql);
    if ($result == FALSE)
    {
        echo 'cannot query';
        exit();
    }
    else
    {
        $id = mysqli_insert_id($connection);

        echo "<p>评论已保存！</p>\n";
        echo "<a href='article.php?id=" . $_POST['article_id'] . "#" . $id  . "'>查看</a>\n";
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
require $_SERVER['DOCUMENT_ROOT'] . "/include/footer.php";
?>
</div>
</body>
</html>