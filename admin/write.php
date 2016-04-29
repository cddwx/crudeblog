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
        <title>xxxx-管理-编辑文章</title>
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
$sql = sprintf("SELECT * FROM `article` WHERE id='%s'",
        mysqli_real_escape_string($connection, $_GET['id']));

if ($_GET['id'] != '')
{
    require($_SERVER['DOCUMENT_ROOT'] . '/include/sql_result_array.php');

    $id         = $object[1]['id'];
    $done       = $object[1]['done'];
    $class      = $object[1]['class'];
    $title      = $object[1]['title'];
    $item       = $object[1]['item'];
    $date       = $object[1]['date'];
    $time       = $object[1]['time'];
    $deadline   = $object[1]['deadline'];

    unset($object);
}
else if ($_GET['class'] != '')
{
    $id         = ''; 
    $done       = ''; 
    $class      = $_GET['class']; 
    $title      = ''; 
    $item       = ''; 
    $date       = ''; 
    $time       = ''; 
    $deadline   = ''; 
}
else
{
    $id         = ''; 
    $done       = ''; 
    $class      = ''; 
    $title      = ''; 
    $item       = ''; 
    $date       = ''; 
    $time       = ''; 
    $deadline   = ''; 
}
?>
<div id='write'>
    <h1 id='page_title'>编辑文章</h1>
    <hr />

    <p class="warning">* 为必填项. 如果添加失败，添加的信息就丢失了，请注意手动保存！或者在失败后使用浏览器返回</p>

    <form action='<?php if ($id == ''){echo 'add.php';}else{echo 'update.php';} ?>' method='post'>
        <table id='write_table'>
            <tr>
                <td class="td_left">标题(*)：</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>" id="write_title" />
                </td>
            </tr>
            <tr>
                <td class='td_left vertical_top'>正文：</td>
                <td>
                    <textarea name="item" id='write_text'><?php echo $item; ?></textarea>
                </td>
            </tr>

            <tr>
                <td class="td_left">分类(*)：</td>
                <td>
                    <select name='class'>
                        <option value='select_class'>选择分类</option>
                        <option value='separete_line' disabled='disabled'>----------------</option>
<?php
$sql = 'SELECT DISTINCT `class` FROM `article` ORDER BY `class`';

require($_SERVER['DOCUMENT_ROOT'] . '/include/sql_result_array.php');

$i = 1;
$ii = count($object);
for($i =1; $i <= $ii; $i = $i + 1)
{
    $class_entry  = $object[$i]['class'];

    if ($class_entry == $class)
    {
        echo "<option value='" . $class_entry . "' selected='selected'>" . $class_entry . "</option>\n";
    }
    else
    {
        echo "<option value='" . $class_entry . "'>" . $class_entry . "</option>\n";
    }
}

unset($object);
?>
                    </select>

                    <span>添加分类</span>
                    <input type='text' name='new_class' value='' />
                </td>
            </tr>

            <tr>
                <td class="td_left">日期：</td>
                <td><?php echo $date; ?></td>
            </tr>
            <tr>
                <td class="td_left">截止日期：</td>
                <td>
                    <input type="text" name="deadline" value="<?php echo $deadline; ?>" />
                </td>
            </tr>

            <tr>
                <td class="td_left">完成情况：</td>
                <td>
<?php 
if ($done == '1')
{
    echo "<label for='yes'>已完成</label>\n";
    echo "<input type='radio' name='done' id='yes' value='1' checked='checked' />\n";
    echo "<label for='no'>待办</label>\n";
    echo "<input type='radio' name='done' id='no' value='0' />\n";
}
else
{
    echo "<label for='yes'>已完成</label>\n";
    echo "<input type='radio' name='done' id='yes' value='1'/>\n";
    echo "<label for='no'>待办</label>\n";
    echo "<input type='radio' name='done' id='no' value='0' checked='checked' />\n";
}
?>
                </td>
            </tr>

            <tr>
                <td class='td_left'></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" name="submit" value="保存" />
                </td>
            </tr>
        </table>
    </form >
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
