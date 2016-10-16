<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';

if (isset($_POST[enviar])) {
     $_SESSION[mes] = $_POST[mes];
     $_SESSION[filtro]="where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
     header("Location:c07");
}

include("header.php");
_PERMITG("comm07a,comm07p,comm07u,comm07v");
_DATATABLE('#tablatodo');
?>
<h1>Intercambio de comunicaciones</h1>
<h4>Intercambio de comunicaciones</h4>

<div class="row">
     <div class="col-lg-3">
          <a href="c00imp" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Importar desde CD"><span class="glyphicon glyphicon-import"></span></a>
          <a href="c07dashboard" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Cuadro de mando"><span class="glyphicon glyphicon-stats"></span></a>
          <a href="#" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reportes"><span class="glyphicon glyphicon-print"></span></a>
          <br>
          <br>
     </div>

</div>
<div class="row">
     <div class="col-md-6">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span>
                         INTERCAMBIO DE COMUNICACIONES
                    </h3>
               </div>
               <div class="panel-body ">
                    <table class="table table-condensed table-hover table-striped nowrap" id="tablatodo" width="100%">
                         <thead>
                              <tr>
                                   <th>AÑO-MES</th>
                                   <th>UP</th>
                                   <th>COMPLETADO</th>
                                   <th>PENDIENTES</th>
                                   <th>TOTAL</th>
                                   <th></th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $queryd = "select date_format(mes,'%Y-%m') t, nombre1, sum(respuestas) respuestas, sum(detotal-respuestas) pendientes, sum(detotal) total FROM comms.general07total group by 1,2 "
                              .        " ";
                              $result = mysqli_query($link, $queryd);
                              mysqli_data_seek($result, 0);
                              while ($row = mysqli_fetch_array($result)) {

                                   ?>
                                   <tr>
                                        <td>
                                             <span class="glyphicon glyphicon-unchecked text-muted"></span>
                                             <?php echo $row['t'] ?>
                                        </td>
                                        <td><?php echo $row['nombre1'] ?></td>
                                        <td><?php echo $row['respuestas'] ?></td>
                                        <td><?php echo $row['pendientes'] ?></td>
                                        <td><?php echo $row['total'] ?></td>


                                        <td>
                                             <a href="#" data-toggle="tooltip" data-placement="top" title="ELIMINAR">
                                                  <span class="glyphicon glyphicon-trash text-danger"></span>
                                             </a>
                                        </td>
                                   </tr>
                                   <?php
                              }
                              ?>

                         </tbody>
                    </table>
               </div>
               <div class="panel-footer">
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-lg-4">
     </div>
</div>
<?php
include("footer.php");
?>
