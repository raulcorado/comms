<?php
include 'secure.php';
include 'app/connection.php';



if (isset($_POST[enviar])) {
     $_SESSION[mes] = $_POST[mes];
     $_SESSION[filtro]="where `mes`='$_SESSION[mes]'";
     header("Location:c10");
}
include("header.php");

// 1 administradores
// 2 operadoresua
// 3 tecnicos
// 4 gerentes
// 5 subgerentes
_PERMITG("comm10");
_DATATABLE('#tablac10');
?>

<h1>Control de FWL</h1>
<h4>Control de FWL</h4>

<div class="row">
     <div class="col-lg-3">
          <div class="panel panel-info">
               <div class="panel-heading">
                    <h3 class="panel-title">
                         OPCIONES
                    </h3>
               </div>
               <div class="panel-body ">
                    <a href="c10dashboard" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Cuadro de mando"><span class="glyphicon glyphicon-stats"></span></a>
                    <a href="#" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reportes"><span class="glyphicon glyphicon-print"></span></a>
                    <hr>
                    <form role="form" action="c10" method="post"  class="form-horizontal">
                         <label for="enviar">MES:</label>
                         <div class="input-group">
                              <select class="form-control input-sm info" name="mes" required="required">
                                   <?php
                                   echo "<option value='' >seleccione</option>";
                                   $mes = date("Y-m",strtotime("-1 Months"));
                                   echo "<option value='" . $mes . "' " . ($mes == $_SESSION[mes] ? "selected" : "") . ">" . $mes . "</option>";
                                   $mes = date("Y-m",strtotime("-0 Months"));
                                   echo "<option value='" . $mes . "' " . ($mes == $_SESSION[mes] ? "selected" : "") . ">" . $mes . "</option>";
                                   $mes = date("Y-m",strtotime("+1 Months"));
                                   echo "<option value='" . $mes . "' " . ($mes == $_SESSION[mes] ? "selected" : "") . ">" . $mes . "</option>";
                                   ?>
                              </select>
                              <span class="input-group-btn">
                                   <button type="submit" name="enviar" class="btn btn-sm input-sm btn-info" type="button"><span class='glyphicon glyphicon-refresh'></span></button>
                              </span>
                         </div>
                    </form>
                    <hr>


               </div>
          </div>
     </div>

     <div class="col-lg-9">
          <div class="panel panel-info">
               <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span>
                         FWL [<?php echo $_SESSION['mes']  ?>]
                    </h3>
               </div>
               <div class="panel-body ">
                    <table class="table table-condensed table-hover table-striped nowrap" id="tablac10" width="100%">
                         <thead>
                              <tr>
                                   <th>UP</th>
                                   <th>SC</th>
                                   <th>NOMBRE</th>
                                   <th>DOB</th>
                                   <th>EDAD</th>
                                   <th>RECIBIDO UA</th>
                                   <th>ESTATUS</th>
                                   <th></th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $queryd = "select * from general10scactive "
                              .        " where `mes`='$_SESSION[mes]'";                              
                              $result = mysqli_query($link, $queryd);
                              mysqli_data_seek($result, 0);
                              while ($row = mysqli_fetch_array($result)) {
                                   // if ($row['est']=="RECIBIDO TARDE") {
                                   //       $class_due="class='text-warning'";
                                   //       $class_ua="class='text-warning'";
                                   //       $class_icon="class='glyphicon glyphicon-ok text-warning'";
                                   // } elseif ($row['est']=="RECIBIDO EN TIEMPO") {
                                   //       $class_due="class='text-success'";
                                   //       $class_ua="class='text-success'";
                                   //       $class_icon="class='glyphicon glyphicon-ok text-success'";
                                   // } elseif ($row['est']=="PENDIENTE VENCIDO") {
                                   //       $class_due="class='text-danger'";
                                   //       $class_ua="class='text-danger'";
                                   //       $class_icon="class='glyphicon glyphicon-pencil text-muted'";
                                   // } else {
                                   //       $class_due="";
                                   //       $class_ua="";
                                   $class_icon="class='glyphicon glyphicon-unchecked text-muted'";
                                   // }
                                   ?>
                                   <tr>
                                        <td>
                                             <span class="glyphicon glyphicon-file text-muted"></span>
                                             <?php echo $row['spucode'] ?>
                                        </td>
                                        <td><?php echo $row['sscnumber'] ?></td>
                                        <td><?php echo $row['sscname'] ?></td>
                                        <td><?php echo $row['sdob'] ?></td>
                                        <td><?php echo $row['edad'] ?></td>
                                        <td><?php echo $row['fechaua'] ?></td>


                                        <td <?php //echo "$class_ua"; ?>>
                                             <span class='glyphicon glyphicon-th text-info'></span>
                                             <?php //echo $row['spuname'] ?>
                                        </td>
                                        <td>
                                             <a href="c10reg?sc=<?php echo $row['sscnumber']?>" data-toggle="tooltip" data-placement="top" title="EDITAR">
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
