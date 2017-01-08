<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/site_define.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/sql_connect.php');
?>
<?php 
session_start();

if ($_SESSION['authenticated'] == '1')
{
    header("Location: index.php");
    exit;
}
else
{
    if (($_POST['user'] != '') && ($_POST['password'] != ''))
    {
        if (($_POST['user'] == ADMIN) && ($_POST['password'] == ADMIN_PASS))
        {
            $_SESSION['authenticated'] = '1';

            header("Location: index.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w4.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="zh-cn" />
<link rel="stylesheet" type="text/css" href="/css/1.css" />
<title><?php echo BLOGNAME; ?>-管理-登入</title>
</head>
<body>
<?php
if (count($_POST) > 0)
{
    echo "<p class='warning'>INVALID LOGIN</p>\n";
}
?>
<form action='login.php' method='post'>
<table class='center'>
<tr>
<td>Username:</td>
<td><input type='text' name='user' value='<?php echo htmlspecialchars($_POST['user']); ?>' /></td>
</tr>
<tr>
<td>Password:</td>
<td><input type='password' name='password' /></td>
</tr>
<tr>
<td></td>
<td><input type='submit' value='login' /></td>
</tr>
</table>
</form>
</body>
</html>