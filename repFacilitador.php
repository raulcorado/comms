<?php

include 'secure.php';
include 'conection.php';
//header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=filename.csv");
header("Cache-Control: max-age=0");


$query = "select `pu code` 'CODIGO UP', `pu name` UP, `afiliation level name` COMUNIDAD, cw FACILITADOR, estatus as ESTATUS, sc SC, `sc name` NOMBRE, gender GENERO, dob 'FECHA NACIMIENTO', concat(if(n_hallazgo=1,'NUTRICION ',''),if(s_hallazgo=1,'SALUD ',''),if(p_hallazgo=1,'PROTECCION ',''),if(e_hallazgo=1,'EDUCACION','')) HALLAZGO, boletafecha 'FECHA BOLETA'  from boletas b left join estatus s on idestatus=s.id left join scactive a on sc=`sc number`  where b.idestatus=1 and `pu code`='$_SESSION[depto]' order by 4,1,2,3,5";
$result = mysqli_query($link, $query);
$field_cnt = mysqli_num_fields($result);
mysqli_data_seek($result, 0);
while ($property = mysqli_fetch_field($result)) {
    echo $property->name . ",";
}


mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_row($result)) {
    echo "\n";
    for ($i = 0; $i <= $field_cnt; $i++) {
        echo $row[$i] . ",";
    }
}
echo "\n";
echo date('Y') . "Plan Guatemala - Aplicación " . $miapp;
?> 


