<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';

if (isset($_POST[enviar])) {
     $_SESSION[mes] = $_POST[mes];
     $_SESSION[filtro]="where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
     header("Location:c06");
}

include("header.php");
_PERMITG("comm06a,comm06p,comm06u,comm06v");

_DATATABLE('#tablatodo');
?>
<h1>Carta de bienvenida</h1>
<h4>CArta de bienvenida</h4>

<div class="row">
     <div class="col-lg-3">
          <a href="#" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Importar desde CD"><span class="glyphicon glyphicon-import"></span></a>
          <a href="#" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Cuadro de mando"><span class="glyphicon glyphicon-stats"></span></a>
          <a href="#" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reportes"><span class="glyphicon glyphicon-print"></span></a>
          <br> <br>
          <form role="form" action="c06" method="post"  class="form-horizontal">
               <div class="input-group has-success">
                    <select class="form-control input-sm" name="mes" required="required">
                         <?php
                         $query = "select date_format(duebefore,'%Y-%m') mes from c08todolist group by 1 order by 1";
                         $result = mysqli_query($link, $query);
                         mysqli_data_seek($result, 0);
                         while ($rowd = mysqli_fetch_row($result)) {
                              echo "<option value='" . $rowd[0] . "' " . ($rowd[0] == $_SESSION[mes] ? "selected" : "") . ">" . $rowd[0] . "</option>";
                         }
                         ?>
                    </select>
                    <span class="input-group-btn">
                         <button type="submit" name="enviar" class="btn btn-sm input-sm btn-success" type="button"><span class='glyphicon glyphicon-refresh'></span></button>
                    </span>
               </div>
          </form>
          <br>
     </div>

</div>
<div class="row">
     <div class="col-md-6">
          <div class="panel panel-primary">
               <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span>
                         CARTAS DEL MES [<?php echo $_SESSION['mes']  ?>]
                    </h3>
               </div>
               <div class="panel-body ">
                    <table class="table table-condensed table-hover table-striped nowrap" id="tablatodo" width="100%">
                         <thead>
                              <tr>
                                   <th>TRIM</th>
                                   <th>UP</th>
                                   <th>COMPLETADO</th>
                                   <th>PENDIENTES</th>
                                   <th>%</th>
                                   <th></th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $queryd = "SELECT concat(year(mes),'-',quarter(mes)) trimestre, nombre1, sum(respuestas) respuestas, sum(detotal-respuestas) as pendientes FROM comms.general06total group by 1,2 "
                              .        " ";
                              $result = mysqli_query($link, $queryd);
                              mysqli_data_seek($result, 0);
                              while ($row = mysqli_fetch_array($result)) {

                                   ?>
                                   <tr>
                                        <td>
                                             <span class="glyphicon glyphicon-unchecked text-muted"></span>
                                             <?php echo $row['trimestre'] ?>
                                        </td>
                                        <td><?php echo $row['nombre1'] ?></td>
                                        <td><?php echo $row['respuestas'] ?></td>
                                        <td><?php echo $row['pendientes'] ?></td>
                                        <td><?php echo $row['pendientes'] ?></td>

                                        <td>
                                             <a href="c08reg?idcomp=<?php echo $row['sc'] . $row['comtype'].$row['duebefore']?>" data-toggle="tooltip" data-placement="top" title="EDITAR">
                                                  <span class="glyphicon glyphicon-minus"></span>
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
