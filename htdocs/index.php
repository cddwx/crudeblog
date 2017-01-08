<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/site_define.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/sql_connect.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w4.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="zh-cn" />
<link rel="stylesheet" type="text/css" href="/css/1.css" />
<title><?php echo BLOGNAME; ?></title>
</head>
<body>
<div id='container'>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/header.php');
?>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/side.php');
?>

<!--主体开始-->
<div id='main' class='container_div'>
<div id='main_content' class='normal_div'>
<div id='welcome'>
<div id='shi'>
<h3>crudeblog</h3>
<p>A very simple and straightforward blog system written in PHP..</p>
<!--清除浮动-->
<div class='clear'></div>
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