<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';


if (isset($_POST[enviar])) {
     $_SESSION[fy] = $_POST[fy];
     header("Location:c02");
}
include("header.php");

_PERMITG("comm02a,comm02p,comm02u,comm02v");
_DATATABLE('#tablac02');
?>
<h1>Monitoreo de proyectos</h1>
<h4>Monitoreo de proyectos de la comunidad</h4>
<a href="c02dashboard" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Cuadro de mando"><span class="glyphicon glyphicon-stats"></span>ESTATUS</a>
<a href="#" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Exportar a Excel"><span class="glyphicon glyphicon-print"></span>EXPORTAR</a>
<br><br>

<div class="panel panel-default">
     <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-th"></span>
               MONITOREO DE PROYECTOS EN LA COMUNIDAD
          </h3>
     </div>
     <div class="panel-body ">
          <table class="table table-condensed table-hover table-striped nowrap" id="tablac02" width="100%">
               <thead>
                    <tr>

                         <th>COD</th>
                         <th>UP</th>
                         <th>AREA</th>

                         <th>COMUNIDAD</th>
                         <th>FY16</th>
                         <th>FY17</th>
                         <th></th>

                    </tr>
               </thead>
               <tbody>
                    <?php
                    $queryd = "select * from comms.general02control "
                    ." where (`pucod` in ($_SESSION[miembroup])) order by pucod,areacode,comcode";
                    // echo $_SESSION['miembroup'];
                    // echo "$queryd";
                    $result = mysqli_query($link, $queryd);
                    mysqli_data_seek($result, 0);
                    while ($row = mysqli_fetch_array($result)) {
                         if (($row['fy16'])>0) {
                              $class_icon16="class='glyphicon glyphicon-ok text-muted'";
                         } else {
                              $class_icon16="class='glyphicon glyphicon-option-horizontal text-muted'";
                         }
                         if (($row['fy17'])>0) {
                              $class_icon17="class='glyphicon glyphicon-ok text-muted'";
                         } else {
                              $class_icon17="class='glyphicon glyphicon-option-horizontal text-muted'";
                         }

                         ?>
                         <tr>

                              <td><span class="glyphicon glyphicon-th text-muted"></span>   <?php echo $row['pucod'].'-'.$row['areacode'].'-'.$row['comcode'] ?></td>
                              <td>
                                   <?php echo $row['puname'] ?>
                              </td>
                              <td><?php echo $row['areaname'] ?></td>
                              <td><?php echo $row['comname'] ?></td>
                              <td class="text-muted"><span <?php echo $class_icon16 ?>></span><?php echo $row['fy16'] ?></td>
                              <td class="text-muted"><span <?php echo $class_icon17 ?>></span><?php echo $row['fy17'] ?></td>
                              <td>
                                   <a href="c02reg?comm=<?php echo $row['locationtagid']?>" data-toggle="tooltip" data-placement="top" title="EDITAR" >
                                        <span class="glyphicon glyphicon-edit text-primary"></span>
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



<?php
include("footer.php");
?>
