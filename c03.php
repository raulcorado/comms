<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';


if (isset($_GET[msg])) {
     $msg = "<p class='text-info'><span class='glyphicon glyphicon-bell' aria-hidden='true'></span>$_GET[msg]</p>";
}
include 'header.php';
_PERMITG("comm03a,comm03p,comm03u,comm03v");
?>



<style type="text/css">
#panel{
     display: none
}
</style>

<script type="text/javascript">

$(window).load(function () {
     $("#waiting").hide();
     $("#panel").show();
});

$(document).ready(function () {
     $('#tablacasos').DataTable({
          "paging": true,
          "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "TODOS"]],
          "pageLength": 100,
          //     "order": [[0, "desc"]],
          // "scrollX": true,
          "info": true,
          "stateSave": true,
          "pagingType": "full",
          "language": {
               "lengthMenu": "_MENU_",
               "zeroRecords": "NADA QUE MOSTRAR",
               "search":         "",
               "paginate": {
                    "first":      "PRIM",
                    "last":       "ULTM",
                    "next":       ">",
                    "previous":   "<"
               },
               "infoEmpty": "NADA QUE MOSTRAR",
               "info":           "DEL _START_ AL _END_ = _TOTAL_ REGISTROS",
               "infoFiltered": "(TOTAL _MAX_ REGISTROS)"
          },
     });
});
</script>




<div class="container-fluid">
     <div class="row">
          <div class="col-xs-12 col-md-12">
               <h1>Casos</h1>
               <h4>Casos</h4>


               <?php echo $msg ?>
               <p id="waiting" class="text-center text-danger" >Esperando . . . </p>
               <a href="c03dashboard" class="btn btn-xs btn-warning"><span class='glyphicon glyphicon-stats'></span>CUADRO</a>
               <span data-toggle="tooltip" data-placement="right" title="Antes de crear un nuevo caso, busque SC en la tabla de abajo">

                    <a href="#" data-target="#modalsc" class="btn btn-xs btn-danger" data-toggle="modal"><span class='glyphicon glyphicon-plus'></span>CREAR NUEVO CASO</a>
               </span>

               <br>
               <br>
               <div id="panel" class="panel panel-warning">
                    <div class="panel-heading">
                         <a href="c03repFacilitador" data-toggle="tooltip" data-placement="right" title="Reporte casos ABIERTOS" ><span class="glyphicon glyphicon-print" aria-hidden="true"> </span></a>
                    </div>
                    <div class="panel-body">
                         <table id="tablacasos" class="table table-condensed table-hover nowrap" width="100%">
                              <thead>
                                   <tr>
                                        <th>UP</th>
                                        <th>FECHA</th>
                                        <th>ESTATUS</th>
                                        <th>SC</th>
                                        <th>NOMBRE</th>
                                        <th>FDC</th>
                                        <th>HALLAZGO</th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   $query = "select b.id as id, date_format(boletafecha,'%Y-%m-%d') as fecha, sc, `sc name` scname, idestatus, n_hallazgo, s_hallazgo, p_hallazgo, e_hallazgo, `pu name` as up, cw, estatus, right(dob,4) as fn FROM c03boletas b left join scactive a on sc=`sc number` left join c03estatus e on b.idestatus=e.id "
                                   . "where `a`.`pu code` in ($_SESSION[miembroup]) order by 1 desc";
                                   $result = mysqli_query($link, $query);
                                   //                            echo mysql_errno($link) . ": " . mysql_error($link) . "\n";

                                   mysqli_data_seek($result, 0);
                                   while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                             <td><?php echo $row['up'] ?></td>
                                             <td><?php echo $row['fecha'] ?></td>
                                             <?php
                                             if (($row['estatus'] == "ABIERTO")and ( $row['e_hallazgo'] <> 1)) {
                                                  $dias = round((strtotime(date('Y-m-d')) - strtotime($row['fecha'])) / (86400));
                                                  ?>



                                                  <td> <?php echo "$row[estatus]" ?></td>
                                                  <?php } else { ?>
                                                       <td> <?php echo "$row[estatus]" ?></td>
                                                       <?php
                                                  }
                                                  ?>

                                                  <td><?php echo $row['sc'] ?></td>
                                                  <td><?php echo "$row[scname] " ?></td>
                                                  <td><?php echo $row['cw'] ?></td>
                                                  <td><?php
                                                  echo ($row['n_hallazgo'] == 1 ? "NUTRICION " : "")
                                                  . ($row['s_hallazgo'] == 1 ? "SALUD " : "")
                                                  . ($row['p_hallazgo'] == 1 ? "PROTECCION " : "")
                                                  . ($row['e_hallazgo'] == 1 ? "EDUCACION " : "");
                                                  ?></td>

                                                  <td>
                                                       <a href='c03casosa?id=<?php echo $row['id'] ?>' data-toggle="tooltip" data-placement="top" title="Editar"><span class='glyphicon glyphicon-pencil text-primary'></span></a>
                                                       <a href='c03casoss?id=<?php echo $row['id'] ?>' data-toggle="tooltip" data-placement="top" title="Seguimiento"><span class='glyphicon glyphicon-folder-open text-success'></span></a>
                                                       <!--                                        <a href='#'                               class="btn btn-xs btn-danger">BORRAR</a>-->
                                                  </td>
                                             </tr>
                                             <?php } ?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>



          <!-- Modal SC -->
          <div id="modalsc" class="modal fade" role="dialog">
               <div class="modal-dialog modal-sm">
                    <!-- Modal content-->
                    <div class="modal-content">
                         <div class="modal-header bg-success">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true">  </span>NUEVO CASO</h4>
                         </div>
                         <div class="modal-body">
                              <div class="container-fluid">










                                   <form role="form" class="form-horizontal" action="c03casosa" method="get">

                                        <div class="form-group">

                                             <div class="col-xs-12">


                                                  <label for="nuevo_caso">NUMERO SC:</label>
                                                  <input name="nuevo_caso" class="awesomplete" list="mylist" />
                                                  <datalist id="mylist">
                                                       <?php
                                                       //$query = "select `sc number`, `sc name`, `pu name` from scactive order by 1";
                                                       $query = "select `sc number`, `sc name`, `pu name` from scactive where `pu code` in ($_SESSION[miembroup]) order by 1 ";
                                                       $result = mysqli_query($link, $query);
                                                       mysqli_data_seek($result, 0);
                                                       while ($row = mysqli_fetch_row($result)) {
                                                            echo "<option>$row[0]</option>";
                                                       }
                                                       ?>
                                                  </datalist>
                                             </div>
                                        </div>

                                        <div>
                                             <button type="submit" class="btn btn-sm  btn-success"><span class='glyphicon glyphicon-ok'> </span> Aceptar</button>
                                             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><span class='glyphicon glyphicon-remove'> </span> Cancelar</button>
                                        </div>

                                        <hr />
                                   </form>
                              </div>
                         </div>
                         <div class="modal-footer bg-success">

                         </div>
                    </div>
               </div>
          </div>

          <?php include 'footer.php'; ?>
