<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';



$filtro = "1=1 "
. "and year(estatusfecha)=year(now()) ";
$fhallazgo = "EDUCACION";
$filtrodesc = "| " . date('Y');

if (isset($_POST['filtrar'])) {
     $filtro = "1=1 ";
     $filtrodesc = "";

     if ($_POST[cw] != "") {
          $filtro = $filtro . "and cw='$_POST[cw]' ";
          $filtrodesc = $filtrodesc . " | " . $_POST[cw];
     }
     if ($_POST[pucode] != "") {
          $filtro = $filtro . "and `pu code`='$_POST[pucode]' ";
          $filtrodesc = $filtrodesc . " | " . $_POST[pucode];
     }
     if ($_POST[afiliationlevelname] != "") {
          $filtro = $filtro . "and `afiliation level name`='$_POST[afiliationlevelname]' ";
          $filtrodesc = $filtrodesc . " | " . $_POST[afiliationlevelname];
     }
     if ($_POST[idestatus] != "") {
          $filtro = $filtro . "and `idestatus`='$_POST[idestatus]' ";
          $filtrodesc = $filtrodesc . " | ESTATUS " . $_POST[idestatus];
     }
     if ($_POST[hallazgo] != "") {
          $filtro = $filtro . "and $_POST[hallazgo]_hallazgo='1' ";
          if ($_POST[hallazgo] == "n") {
               $fhallazgo = "NUTRICION";
          }
          if ($_POST[hallazgo] == "s") {
               $fhallazgo = "SALUD";
          }
          if ($_POST[hallazgo] == "p") {
               $fhallazgo = "PROTECCION";
          }
          if ($_POST[hallazgo] == "e") {
               $fhallazgo = "EDUCACION";
          }
          $filtrodesc = $filtrodesc . " | " . $fhallazgo;
     }
     if ($_POST[ano] != "") {
          $filtro = $filtro . "and year(estatusfecha)='$_POST[ano]' ";
          $filtrodesc = $filtrodesc . " | " . $_POST[ano];
     }
     if ($_POST[trim] != "") {
          $filtro = $filtro . "and quarter(estatusfecha)='$_POST[trim]' ";
          $filtrodesc = $filtrodesc . " | TRIMESTRE " . $_POST[trim];
     }
     if (isset($_POST[entre])) {
          $filtro = $filtro . "and estatusfecha  between '$_POST[del]' and '$_POST[al]' ";
          $filtrodesc = $filtrodesc . " | DEL " . $_POST[del] . " AL " . $_POST[al];
     }


     if ($filtrodesc == "") {
          $filtrodesc = "| ningún filtro definido";
     }
}
$filtrodesc = "<span class='glyphicon glyphicon-filter'></span>" . $filtrodesc . " |";



include 'header.php';
_PERMITG("comm03a,comm03p,comm03u,comm03v");
?>

<!-- Modal SC -->
<div id="modalfiltro" class="modal fade" role="dialog">
     <div class="modal-dialog ">
          <!-- Modal content-->
          <div class="modal-content">
               <div class="modal-header bg-warning">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-filter" aria-hidden="true">  </span>FILTRO</h4>
               </div>
               <div class="modal-body">
                    <div class="container-fluid">
                         <form role="form" class="form-horizontal" action="c03dashboard" method="post">
                              <h4>SELECCIONE UNO O VARIOS CAMPOS</h4>
                              <hr />
                              <div class="form-group">
                                   <div class="col-xs-4">
                                        <label for="cw">Facilitador:</label>
                                        <select class="form-control input-sm" id="cw" name="cw">
                                             <option value="" selected>todos</option>
                                             <?php
                                             $query = "select `cw` from c03boletas left join scactive on sc=`sc number` group by 1 order by 1";
                                             $result = mysqli_query($link, $query);
                                             mysqli_data_seek($result, 0);
                                             while ($row = mysqli_fetch_row($result)) {
                                                  echo "<option value='$row[0]'>$row[0]</option>";
                                             }
                                             ?>
                                        </select>
                                   </div>
                                   <div class="col-xs-4">
                                        <label for="pucode">UP:</label>
                                        <select class="form-control input-sm" id="pucode" name="pucode">
                                             <option value="" selected>todos</option>
                                             <?php
                                             $query = "select depto from sdepto order by 1";
                                             $result = mysqli_query($link, $query);
                                             mysqli_data_seek($result, 0);
                                             while ($row = mysqli_fetch_row($result)) {
                                                  echo "<option value='$row[0]'>$row[0]</option>";
                                             }
                                             ?>
                                        </select>
                                   </div>
                                   <div class="col-xs-4">
                                        <label for="afiliationlevelname">Comunidad:</label>
                                        <select class="form-control input-sm" id="afiliationlevelname" name="afiliationlevelname">
                                             <option value="" selected>todos</option>
                                             <?php
                                             $query = "select `pu code`, `afiliation level name` from c03boletas left join scactive on sc=`sc number` group by 2 order by 1, 2";
                                             $result = mysqli_query($link, $query);
                                             mysqli_data_seek($result, 0);
                                             while ($row = mysqli_fetch_row($result)) {
                                                  echo "<option value='$row[1]'>$row[1] ($row[0])</option>";
                                             }
                                             ?>
                                        </select>
                                   </div>
                              </div>

                              <div class="form-group">
                                   <div class="col-xs-4">
                                        <label for="idestatus">ESTATUS:</label>
                                        <select class="form-control input-sm" id="idestatus" name="idestatus">
                                             <option value="" selected>todos</option>
                                             <?php
                                             $query = "select id, estatus from c03estatus order by 1";
                                             $result = mysqli_query($link, $query);
                                             mysqli_data_seek($result, 0);
                                             while ($row = mysqli_fetch_row($result)) {
                                                  echo "<option value='$row[0]'>$row[1]</option>";
                                             }
                                             ?>
                                        </select>
                                   </div>
                                   <div class="col-xs-4">
                                        <label for="hallazgo">HALLAZGO:</label>
                                        <select class="form-control input-sm" id="hallazgo" name="hallazgo">
                                             <option value="" selected>todos</option>
                                             <option value='n'>NUTICION</option>
                                             <option value='s'>SALUD</option>
                                             <option value='p'>PROTECCION</option>
                                             <option value='e'>EDUCACION</option>

                                        </select>
                                   </div>
                                   <div class="col-xs-4">
                                   </div>
                              </div>

                              <div class="form-group">
                                   <div class="col-xs-4">
                                        <label for="ano">AÑO:</label>
                                        <select class="form-control input-sm" id="ano" name="ano">
                                             <option value="" selected>todos</option>
                                             <?php
                                             $query = "select year(estatusfecha) from c03boletas group by 1 order by 1";
                                             $result = mysqli_query($link, $query);
                                             mysqli_data_seek($result, 0);
                                             while ($row = mysqli_fetch_row($result)) {
                                                  echo "<option value='$row[0]' " . (date('Y') == $row[0] ? "selected" : "") . " >$row[0]</option>";
                                             }
                                             ?>
                                        </select>

                                   </div>
                                   <div class="col-xs-4">

                                        <label for="trim">Trimestre:</label>
                                        <select class="form-control input-sm" id="trim" name="trim">
                                             <option value="" selected>todos</option>
                                             <option value='1'>1</option>
                                             <option value='2'>2</option>
                                             <option value='3'>3</option>
                                             <option value='4'>4</option>
                                        </select>


                                   </div>

                              </div>
                              <div class="form-group">
                                   <div class="col-xs-4">
                                        <div class="checkbox"><label><input type="checkbox" name="entre"> Entre</label></div>
                                   </div>
                                   <br />
                                   <div class="col-xs-4">
                                        <label for="boletafecha">DEL:</label>
                                        <input type="date" name="del" class="form-control input-sm" value="<?php echo date() ?>">
                                   </div>
                                   <div class="col-xs-4">
                                        <label for="boletafecha">AL:</label>
                                        <input type="date" name="al" class="form-control input-sm" value="<?php echo date() ?>">
                                   </div>
                              </div>

                              <hr />
                              <div class="text-right">
                                   <button type="submit" class="btn btn-success" name="filtrar"><span class='glyphicon glyphicon-ok'> </span>Aceptar</button>
                                   <button type="button" class="btn btn-danger" data-dismiss="modal"><span class='glyphicon glyphicon-remove'> </span>Cancelar</button>
                              </div>


                         </form>
                    </div>
               </div>
               <div class="modal-footer bg-success">

               </div>
          </div>
     </div>
</div>

<div class="row">
<h1>Casos Boleta de Reporte Inmediato</h1>
<h4>Cuadro de mando</h4>

     <div class="text-left">
          <span data-toggle="tooltip" data-placement="left" title="Definir filtro">
               <a href="#" data-target="#modalfiltro" class="btn btn-xs btn-warning" data-toggle="modal"><span class='glyphicon glyphicon-filter'></span>FILTRO</a>
          </span>
          <a href="c03dashboard" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Quitar filtro"><span class='glyphicon glyphicon-asterisk'> </span>LIMPIAR</a>
     </div>
     <br>
     <div class="panel panel-warning">
          <div class="panel-heading">
               <p><span class="glyphicon glyphicon-info-sign"></span>Información General</p>
          </div>
          <div class="panel-body">
               <h4 class="text-center"><strong>TABLA GENERAL DE CASOS POR ESTATUS</strong></h4>
               <table class="table table-condensed table-hover table-striped table-bordered">
                    <?php
                    echo _TCONTENT(_CROSS("select puname `UP`, estatus from general03boleta", "UP", "estatus", 1));
                    ?>
               </table>

               <hr>
               <?php
               // SERIAL INICIO
               $gquery = "select puname `UP`, estatus from general03boleta ";
               $field1 = "UP";
               $field2 = "estatus";
               include 'fnc/serial.php';
               // SERIAL FINAL

               $id="g1";
               include     'gbar.php';


               ?>

          </div>
     </div>
</div>

<br>

<br />




<?php
include 'footer.php';
?>
