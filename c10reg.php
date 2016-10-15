<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';


if (isset($_POST[enviar])) {
     _PERMITG("comm10a,comm10p,comm10u");
     $d_agradecepatr = (isset($_POST[d_agradecepatr]) ? 1 : 0);
     $d_incplanesfuturos = (isset($_POST[d_incplanesfuturos]) ? 1 : 0);
     $d_mencionaproyectos = (isset($_POST[d_mencionaproyectos]) ? 1 : 0);
     $d_dialogovalioso = (($d_agradecepatr + $d_incplanesfuturos + $d_mencionaproyectos) > 0 ? 1 : 0);
     $query= "replace into `c10control` (`scnumber`,         `nocode`,         `spnumber`,         `spname`,         `dob`,         `age`,         `puserid`,           `fechaua`,         `c_quienescribiocarta`, `d_dialogovalioso`, `d_agradecepatr`, `d_incplanesfuturos`, `d_mencionaproyectos`, `i_contenidoinaprop`) "
     . "                  VALUES ('$_POST[scnumber]', '$_POST[nocode]', '$_POST[spnumber]', '$_POST[spname]', '$_POST[dob]', '$_POST[age]', '$_SESSION[userid]', '$_POST[fechaua]', '$_POST[c_quienescribiocarta]', '$d_dialogovalioso', '$d_agradecepatr', '$d_incplanesfuturos', '$d_mencionaproyectos', '$_POST[i_contenidoinaprop]')";


     $result = mysqli_query($link, $query);
     header("Location:c10");
}


// ELIMINAR REGISTRO
// if (isset($_GET[delete])) {
//       $permit=2;
//       // 1 admin
//       // 2 super user <<<<<<
//       // 3 usuario
//       // 4 visitante
//       if ($_SESSION[rolid]>$permit) {
//             header("Location:403");
//       }
//       $query = "DELETE FROM `c08todolist` WHERE concat(sc,comtype,duebefore)='$_GET[delete]'";
//       $result = mysqli_query($link, $query);
//       $query = "DELETE FROM `c08control` WHERE concat(sc,comtype,duebefore)='$_GET[delete]'";
//       $result = mysqli_query($link, $query);
//       header("Location:c08");
// }


if (isset($_GET[sc])) {
     // $query = "select t.*, fechaua, p_participosc, p_dibujo, p_carta, p_huella, c_quienescribiocarta, d_dialogovalioso, d_foto, d_resppreguntas, d_hacepreguntas, d_cuentafamcomuni, d_mencionaproyectos, i_contenidoinaprop from c08todolist t left join c08control c on concat(t.sc,t.comtype,t.duebefore)=concat(c.sc, c.comtype, c.duebefore) "
     // . " where concat(t.sc,t.comtype,t.duebefore)='$_GET[idcomp]'";
     $sc = $_GET[sc];
     $query = "select * from general10scactive "
     . " where `sscnumber`='$sc'";
     $result = mysqli_query($link, $query);
     $row_cnt = mysqli_num_rows($result);
     if ($row_cnt==0) {
          header("Location:c10");
     }
     $row = mysqli_fetch_array($result);
     $fechaua=($row[fechaua]==""? date('Y-m-d') : $row[fechaua]);
     $d_foto = ($row[d_foto] == 1 ? "checked" : "");
     $d_agradecepatr = ($row[d_agradecepatr] == 1 ? "checked" : "");
     $d_incplanesfuturos = ($row[d_incplanesfuturos] == 1 ? "checked" : "");
     $d_mencionaproyectos = ($row[d_mencionaproyectos] == 1 ? "checked" : "");


}

include 'header.php';
_PERMITG("comm10a,comm10p,comm10u,comm10v");
?>


<h1>Control de FWL</h1>
<h4>Control de FWL</h4>

<div class="col-xs-12 col-md-12">
     <div class="panel panel-info">
          <div class="panel-heading">
               <h3 class="panel-title"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>FWL</h3>
          </div>
          <div class="panel-body">
               <div class="col-md-5">
                    <label>INFORMACIÓN:</label>
                    <table class="table table-condensed table-hover table-bordered table-striped">
                         <thead>
                              <tr>
                                   <th><span class="glyphicon glyphicon-paperclip"></span>CAMPO:</th><th>INF:</td>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>SC:</td><td><?php echo $row['sscnumber'] ?></td></tr>
                                   <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>NOMBRE:</td><td><?php echo $row['sscname'] ?></td></tr>
                                   <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>EDAD:</td><td><?php echo $row['edad'] ?></td></tr>
                                   <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>ON:</td><td><?php echo $row['snocode'] ?></td></tr>
                                   <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>SP:</td><td><?php echo $row['sspnumber'] ?></td></tr>
                                   <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>NOMBRE:</td><td><?php echo $row['sspname'] ?></td></tr>

                                   <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>UP:</td><td><?php echo $row['spuname'] ?></td></tr>
                                   <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>FACILITA:</td><td><?php echo $row['scw'] ?></td></tr>
                              </tbody>
                         </table>
                    </div>
                    <div class="col-md-7">
                         <form role="form" action="c10reg" method="post"  class="form-horizontal">
                              <input type="hidden" name="nocode" value="<?php echo $row[snocode]; ?>" required="required" readonly>
                              <input type="hidden" name="spnumber" value="<?php echo $row[sspnumber]; ?>" required="required" readonly>
                              <input type="hidden" name="spname" value="<?php echo $row[sspname]; ?>" required="required" readonly>
                              <input type="hidden" name="age" value="<?php echo $row[edad]; ?>" required="required" readonly>
                              <input type="hidden" name="fechaua" value="<?php echo $row[fechaua]; ?>" required="required" readonly>


                              <div class="form-group">
                                   <div class="col-xs-3">
                                        <label for="pu">UP:</label>
                                        <input type="text" class="form-control input-sm" name="puname" value="<?php echo $row['spuname']; ?>" required="required" readonly>
                                   </div>
                                   <div class="col-xs-3">
                                        <label for="sc">SC:</label>
                                        <input type="text" class="form-control input-sm" name="scnumber" value="<?php echo $row['sscnumber']; ?>" required="required" readonly>
                                   </div>
                                   <div class="col-xs-6">
                                        <label for="scname">NOMBRE SC:</label>
                                        <input type="text" class="form-control input-sm" name="scname" value="<?php echo $row['sscname']; ?>" required="required" readonly>
                                   </div>
                              </div>
                              <div class="form-group">
                                   <div class="col-xs-3">
                                        <label for="fechaua">DOB:</label>
                                        <input type="date" class="form-control input-sm" name="dob" value="<?php echo $row['sdob']; ?>" required="required" readonly>
                                   </div>
                                   <div class="col-xs-3">
                                        <label for="fechaua">RECIBIDO UA:</label>
                                        <input type="date" class="form-control input-sm" name="fechaua" value="<?php echo $fechaua; ?>" required="required">
                                   </div>
                              </div>
                              <hr>
                              <div class="form-group">
                                   <div class="col-xs-6">
                                        <label for="c_quienescribiocarta">QUIÉN ESCRIBIÓ LA FWL:</label>
                                        <select class="form-control input-sm" name="c_quienescribiocarta" required="required">
                                             <option value="" selected>selecciona</option>
                                             <option value="SC" <?php echo ($row['c_quienescribiocarta'] == 'SC' ? "selected" : "") ?>>SC</option>
                                             <option value="FAMILIAR" <?php echo ($row['c_quienescribiocarta'] == 'FAMILIAR' ? "selected" : "") ?>>FAMILIAR</option>
                                             <option value="FACILITADOR" <?php echo ($row['c_quienescribiocarta'] == 'FACILITADOR' ? "selected" : "") ?>>FACILITADOR</option>
                                             <option value="VOLUNTARIO" <?php echo ($row['c_quienescribiocarta'] == 'VOLUNTARIO' ? "selected" : "") ?>>VOLUNTARIO</option>
                                        </select>

                                   </div>
                                   <div class="col-xs-6">
                                        <label for="i_contenidoinaprop">CONTENIDO INAPROPIADO:</label>
                                        <select class="form-control input-sm" name="i_contenidoinaprop" required="required">
                                             <option value="0" selected>NO</option>
                                             <option value="1" <?php echo ($row['i_contenidoinaprop'] == '1' ? "selected" : "") ?>>SI</option>
                                        </select>
                                   </div>
                              </div>
                              <hr>
                              <div class="form-group">
                                   <div class="col-xs-6">
                                        <label >DIÁLOGO VALIOSO:</label>
                                        <div class="checkbox">
                                             <label><input type="checkbox"  name="d_agradecepatr" <?php echo $d_agradecepatr ?>>Agradece el patrocinio</label>
                                        </div>
                                        <div class="checkbox">
                                             <label><input type="checkbox"  name="d_incplanesfuturos" <?php echo $d_incplanesfuturos ?>>Incluye planes futuros</label>
                                        </div>
                                        <div class="checkbox">
                                             <label><input type="checkbox" name="d_mencionaproyectos" <?php echo $d_mencionaproyectos ?>>Menciona proyectos</label>
                                        </div>
                                   </div>
                              </div>

                              <hr>
                              <div class="text-right">
                                   <button type="submit" class="btn btn-success" name="enviar"><span class='glyphicon glyphicon-ok'> </span>Grabar</button>
                                   <a href="c10" class="btn btn-primary"><span class='glyphicon glyphicon-remove'> </span>Cancelar</a>
                                   <a class="btn btn-default disabled" role="button" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1" disabled>
                                        <span class="glyphicon glyphicon-trash"></span>ELIMINAR
                                   </a>
                                   <div class="collapse" id="collapse1">
                                        <p class="text-danger">
                                             <span class="glyphicon glyphicon-info-sign"></span>
                                             SE ELIMINARA EL REGISTRO. ESTÁ SEGURO ??
                                        </p>
                                        <a href="c10reg?delete=<?php echo $idcomp?>"  class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="ELIMINAR TOTALMENTE!">
                                             <span class="glyphicon glyphicon-trash"></span>ELIMINAR
                                        </a>
                                   </div>

                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>






     <?php include 'footer.php'; ?>
