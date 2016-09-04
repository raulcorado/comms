<?php

/*
convierte $gquery en una query cruzada
$field1 son las filas y $field2 seran tantas columnas como datos diferentes encuentre
si $field2=TOTAL no se hará la separacion de las columnas
$tot=1 incluira fila y columna de totales al final
uso:
<?php
// CROSS INICIO
$gquery="select puname `UP`, est from generalcomms ";
$field1="UP";
$field2="est|TOTAL";
$tot=1; //columna totales
include 'fnc/cross.php';
echo $crossquery;
// CROSS FINAL
?>
*/


$colquery = "select a.$field2, count(a.$field2) from ($gquery) a group by 1";
$result = mysqli_query($link, $colquery);
mysqli_data_seek($result, 0);
$countquery = "";
if ($field2 == "TOTAL") {
     $countquery = "count(*) as `TOTAL`";
} else {
     while ($row = mysqli_fetch_row($result)) {
          $countquery = $countquery . (strlen($countquery) > 0 ? ", " : "") . "sum(case when a.$field2='$row[0]' then 1 else 0 end) as `$row[0]`";
     }
     if ($tot==1) {
          $countquery = $countquery . (strlen($countquery) > 0 ? ", " : "") . "count(1) as `TOTAL`";
     }
}
if ($tot==1) {
     $crossquery = "select a.$field1, $countquery from ($gquery) a group by 1  "
     . "union select 'TOTAL', $countquery from ($gquery) a ";
} else {
     $crossquery = "select a.$field1, $countquery from ($gquery) a group by 1 order by sum(1) desc";
}
$gquery=$crossquery;
ob_flush();
flush();
?>
