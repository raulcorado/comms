<?php
/*
Serializa $gquery y totaliza(cruza la tabla con $field2)
USO:
<?php
// SERIAL INICIO
$gquery = "select puname, est from generalcomms ";
$field1 = "puname";
$field2 = "est";
include 'fnc/serial.php';
echo $data;
echo $groups;
// SERIAL FINAL
?>
*/


$crossquery=$gquery;
$tot=0; //columna totales
include 'fnc/cross.php';
$result = mysqli_query($link, $crossquery);
$field_cnt = mysqli_num_fields($result);
mysqli_data_seek($result, 0);
$data = "[[";
while ($property = mysqli_fetch_field($result)) {
     $data = $data . "'$property->name',";
}

mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_row($result)) {
     $data = substr($data, 0, strlen($data) - 1) . "],[";
     for ($i = 0; $i <= $field_cnt - 1; $i++) {
          $data = $data . "'$row[$i]',";
     }
}
$data = substr($data, 0, strlen($data) - 1) . "]]";

// echo $data;
$m = strlen($field1) + 4;
$groups = "[" . substr($data, $m + 1, strpos($data, '],') - $m);


?>
