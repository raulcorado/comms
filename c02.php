<?php
include 'secure.php';
include 'app/connection.php';



if (isset($_POST[enviar])) {
      $_SESSION[fy] = $_POST[fy];
      header("Location:c02");
}
include("header.php");

// 1 administradores
// 2 operadoresua
// 3 tecnicos
// 4 gerentes
// 5 subgerentes
_PERMITG("comm02");
_DATATABLE('#tablac02');
?>
<h1>Monitoreo de proyectos</h1>
<h4>Monitoreo de proyectos de la comunidad</h4>
<a href="#" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Cuadro de mando"><span class="glyphicon glyphicon-stats"></span>ESTATUS</a>
<a href="#" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Exportar a Excel"><span class="glyphicon glyphicon-print"></span>EXPORTAR</a>
<br><br>

<div class="panel panel-danger">
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
                              <th>FECHA REG</th>
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
                              if (isset($row['fechareg'])) {
                                    $class_icon="class='glyphicon glyphicon-check text-success'";
                              } else {
                                    $class_icon="class='glyphicon glyphicon-unchecked text-muted'";
                              }

                              ?>
                              <tr>

                                    <td><span class="glyphicon glyphicon-th text-muted"></span>   <?php echo $row['pucod'].'-'.$row['areacode'].'-'.$row['comcode'] ?></td>
                                    <td>
                                          <?php echo $row['puname'] ?>
                                    </td>
                                    <td><?php echo $row['areaname'] ?></td>
                                    <td><?php echo $row['comname'] ?></td>
                                    <td><?php echo $row['fechareg'] ?></td>
                                    <td>
                                          <a href="c02reg?comm=<?php echo $row['locationtagid']?>" data-toggle="tooltip" data-placement="top" title="EDITAR">
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



<?php
include("footer.php");
?>
