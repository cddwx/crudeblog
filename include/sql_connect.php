<?php
$connection = mysqli_connect(HOST, USER, PASSWORD);
if ($connection == FALSE)
{
    echo "cannot connect to server";
    exit();
}

$select_db = mysqli_select_db($connection, DB);
if ($select_db == FALSE)
{
    echo "cannot select database";
    exit();
}

$character_set = mysqli_set_charset($connection, 'utf8');
if ($character_set == FALSE)
{
    echo "cannot set character_set";
    exit();
}

//$charset = mysqli_character_set_name($connection);
//printf("Current character set is %s\n", $charset);
?>
