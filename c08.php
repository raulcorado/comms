<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';


if (isset($_POST[enviar])) {
     $_SESSION[mes] = $_POST[mes];
     $_SESSION[filtro]="where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
     header("Location:c08");
}

include("header.php");
_PERMITG("comm08a,comm08p,comm08u,comm08v");

_DATATABLE('#tablatodo');
?>
<h1>Control de correspondencia</h1>
<h4>Control de correspondencia</h4>

<div class="row">
     <div class="col-lg-3">
          <a href="c00imp" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Importar desde CD"><span class="glyphicon glyphicon-import"></span></a>
          <a href="c08dashboard" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Cuadro de mando"><span class="glyphicon glyphicon-stats"></span></a>
          <a href="#" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reportes"><span class="glyphicon glyphicon-print"></span></a>
     <br> <br>
          <form role="form" action="c08" method="post"  class="form-horizontal">
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


     <div class="col-md-12">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span>
                         CARTAS DEL MES [<?php echo $_SESSION['mes']  ?>]
                    </h3>
               </div>
               <div class="panel-body ">
                    <table class="table table-condensed table-hover table-striped nowrap" id="tablatodo" width="100%">
                         <thead>
                              <tr>
                                   <th>SC</th>
                                   <th>COM</th>
                                   <th>UP</th>
                                   <th>FACILITADOR</th>
                                   <th>NOMBRE</th>
                                   <th>RECIBIDO</th>
                                   <th>F-LÍMITE</th>
                                   <th>ESTATUS</th>
                                   <th></th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $queryd = "select * from generalcomms "
                              .        " where date_format(duebefore,'%Y-%m')='$_SESSION[mes]' order by `duebefore`, `sc`";
                              $result = mysqli_query($link, $queryd);
                              mysqli_data_seek($result, 0);
                              while ($row = mysqli_fetch_array($result)) {
                                   if ($row['est']=="RECIBIDO TARDE") {
                                        $class_due="class='text-warning'";
                                        $class_ua="class='text-warning'";
                                        $class_icon="class='glyphicon glyphicon-check text-warning'";
                                   } elseif ($row['est']=="RECIBIDO EN TIEMPO") {
                                        $class_due="class='text-success'";
                                        $class_ua="class='text-success'";
                                        $class_icon="class='glyphicon glyphicon-check text-success'";
                                   } elseif ($row['est']=="PENDIENTE VENCIDO") {
                                        $class_due="class='text-danger'";
                                        $class_ua="class='text-danger'";
                                        $class_icon="class='glyphicon glyphicon-unchecked text-muted'";
                                   } else {
                                        $class_due="";
                                        $class_ua="";
                                        $class_icon="class='glyphicon glyphicon-unchecked text-muted'";
                                   }
                                   ?>
                                   <tr>
                                        <td>
                                             <span class="glyphicon glyphicon-file text-muted"></span>
                                             <?php echo $row['sc'] ?>
                                        </td>
                                        <td><?php echo $row['comtype'] ?></td>
                                        <td><?php echo $row['pu'] ?></td>
                                        <td><?php echo $row['facilita'] ?></td>

                                        <td><?php echo $row['scname'] ?></td>
                                        <td <?php echo "$class_ua"; ?>>
                                             <?php echo $row['fechaua'] ?>
                                        </td>
                                        <td <?php echo "$class_due"; ?>>
                                             <?php echo $row['dueua'] ?>
                                        </td>
                                        <td <?php echo "$class_ua"; ?>>
                                             <?php echo $row['est'] ?></td>
                                             <td>
                                                  <a href="c08reg?idcomp=<?php echo $row['sc'] . $row['comtype'].$row['duebefore']?>" data-toggle="tooltip" data-placement="top" title="EDITAR">
                                                       <span <?php echo "$class_icon"?>></span>
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
