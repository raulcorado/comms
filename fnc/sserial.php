<?php

     /*
     SimpleSerial $gquery en formato json
     USO:
     <?php
     //S-SERIAL INICIO
     $gquery = "select puname `UP`, sum(d_foto) FOTO, sum(d_resppreguntas) RESP_PREGUNTAS, . . .";
     $field1 = "UP";
     include 'fnc/sserial.php';
     echo $data;
     echo $groups;
     //S-SERIAL FINAL
     ?>
     */

     $crossquery = $gquery;
     // echo "$crossquery";
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
