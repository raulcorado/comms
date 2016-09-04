<?php

/*
convierte $gquery en una tabla sin incluir los tags <table></table>

uso:
<?php
//TCONTENT INICIO
$gquery="";
include 'fnc/tcontent.php';
//TCONTENT FINAL
?>

*/


$query = $gquery;
$result = mysqli_query($link, $query);
$field_cnt = mysqli_num_fields($result);
mysqli_data_seek($result, 0);
$data="<thead><tr>";

while ($property = mysqli_fetch_field($result)) {
      $data = $data . "<th width='". (100 / ($field_cnt)) . "%'>". $property->name . "</th>";
}
$data=$data . "</tr></thead><tbody>";

mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_row($result)) {
      $data = $data . "<tr>";
      for ($i = 0; $i < $field_cnt; $i++) {
            if ($i==0) {
                  $gi="<span class='glyphicon glyphicon-unchecked text-muted'></span>";
            }
            else {
                  $gi="";
            }
            $data = $data . "<td>" . $gi . $row[$i] . "</td>";
      }
      $data = $data . "</tr>";
}
$data = $data . "</tbody>";
echo $data;
?>
