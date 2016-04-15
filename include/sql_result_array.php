<?php
$result = mysqli_query($connection, $sql);
if ($result == FALSE)
{
    echo "cannot query in sql_result_array";
    exit();
}
$num_fields = mysqli_num_fields($result);
//echo $num_fields;

//unset($object);

$x = 1;
$y = 1;
while($row = mysqli_fetch_assoc($result))
{ 
    for($y = 1; $y <= $num_fields; $y = $y + 1)
    {
        $field_info = mysqli_fetch_field_direct($result, $y - 1);
        $name = $field_info->name;
        $object[$x][$name] = $row[$name];
        //echo $y . ', ';
    }
    $x = $x + 1;
    //echo $x . ', ';
    //echo $object[$x]['class'] . ', ';
}
?>
