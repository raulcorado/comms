<?php

function _AUT($roles, $groups) {
      $permit=4;
      // 1 admin
      // 2 super user <<<<<<
      // 3 usuario
      // 4 visitante
      if ($_SESSION[rolid]>$permit) {
            header("Location:403");
      }
}


function _DATATABLE($table) {
      ?>
      <script type="text/javascript">
      $(document).ready(function () {
            $('<?php echo $table ?>').DataTable({
                  "paging": true,
                  "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "TODOS"]],
                  "pageLength": 100,
                  // "order": [[0, "desc"]],
                  // "scrollX": true,
                  "info": true,
                  "stateSave": true,
                  "pagingType": "full",
                  "deferRender": true,
                  "language": {
                        "lengthMenu": "_MENU_",
                        "zeroRecords": "NADA QUE MOSTRAR",
                        "search":         "",
                        "paginate": {
                              "first":      "PRIM",
                              "last":       "ULTM",
                              "next":       "SIG",
                              "previous":   "ANT"
                        },
                        "infoEmpty": "NADA QUE MOSTRAR",
                        "info": "DEL _START_ AL _END_ = _TOTAL_ REGISTROS",
                        "infoFiltered": "(TOTAL _MAX_ REGISTROS)"
                  },
            });
      });
      </script>
      <?php
}


function _CROSS($gquery, $field1, $field2, $tot) {
      /*
      regresa $gquery en una query cruzada
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
      global $link;
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
      return $gquery;
}


function _SERIAL($gquery, $field1, $field2, $cross) {
      /*
      Serializa $gquery y totaliza(cruza la tabla con $field2 sin totalizar)
      tambien regresa $groups para agrupar en las graficas c3js.org
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

      global $link;
      if ($cross==1) {
            $crossquery = _CROSS($gquery, $field1, $field2, 0);
      } else {
            $crossquery = $gquery;
      }

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
      ob_flush();
      flush();
      return array($data, $groups);
}

function _TCONTENT($gquery) {
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

      global $link;
      $query = $gquery;
      $result = mysqli_query($link, $query);
      $field_cnt = mysqli_num_fields($result);
      mysqli_data_seek($result, 0);
      $data="<thead><tr>";
      $i=0;
      while ($property = mysqli_fetch_field($result)) {
            if ($i==0) {
                  $gi="";
            }
            else {
                  $gi="class='text-right'";
            }
            $data = $data . "<th " . $gi . " width='". (100 / ($field_cnt)) . "%'>". $property->name . "</th>";
            $i++;
      }
      $data=$data . "</tr></thead><tbody>";

      mysqli_data_seek($result, 0);
      while ($row = mysqli_fetch_row($result)) {
            $data = $data . "<tr>";
            for ($i = 0; $i < $field_cnt; $i++) {
                  if ($i==0) {
                        $gi="<td><span class='glyphicon glyphicon-unchecked text-muted'></span>";
                  }
                  else {
                        $gi="<td class='text-right'>";
                  }
                  $data = $data . $gi . $row[$i] . "</td>";
            }
            $data = $data . "</tr>";
      }
      $data = $data . "</tbody>";
      ob_flush();
      flush();
      return $data;
}

function _CHART($data, $groups, $field1, $type, $pattern) {
      /*
      USO:
      <?php
      // GBAR INICIA
      $id="g01";
      $field1="puname";
      $data="[json]";
      $groups="[json]";
      $pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
      include "gbar.php";
      // GBAR FINALIZA
      ?>
      */
      $id="G" . rand();
      ?>

      <div id="<?php echo $id ?>"></div>
      <script type="text/javascript">
      var chart = c3.generate({
            bindto: '<?php echo "#$id" ?>',
            data: {
                  x: '<?php echo $field1 ?>',
                  rows: <?php echo $data ?>,
                  groups: [<?php echo $groups ?>],
                  type: '<?php echo $type ?>',
                  order: 'desc',
            },
            grid: {
                  x: {
                        show: true
                  }
            },
            color: {
                  pattern: [<?php echo $pattern ?>]
            },
            gauge: {
                  width: 40
            },
            //   legend: {
            //       position: 'right'
            //   },
            axis: {
                  x: {
                        type: 'category'
                  },
                  // y: {
                  //     show: false
                  // }
                  // rotated: true
            },


            point: {
                  show: true
            },
      });
      </script>
      <?php
}

?>
