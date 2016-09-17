<?php
include 'secure.php';
include 'app/connection.php';

$permit=3;
// 1 admin
// 2 super user <<<<<<
// 3 usuario
// 4 visitante
if ($_SESSION[rolid]>$permit) {
      header("Location:403");
}


if (isset($_POST[enviar])) {
      $p_dibujo = (isset($_POST[p_dibujo]) ? 1 : 0);
      $p_carta = (isset($_POST[p_carta]) ? 1 : 0);
      $p_huella = (isset($_POST[p_huella]) ? 1 : 0);
      $p_participosc = (($p_dibujo + $p_carta + $p_huella) > 0 ? 1 : 0 );

      $d_foto = (isset($_POST[d_foto]) ? 1 : 0);
      $d_resppreguntas = (isset($_POST[d_resppreguntas]) ? 1 : 0);
      $d_hacepreguntas = (isset($_POST[d_hacepreguntas]) ? 1 : 0);
      $d_cuentafamcomuni = (isset($_POST[d_cuentafamcomuni]) ? 1 : 0);
      $d_mencionaproyectos = (isset($_POST[d_mencionaproyectos]) ? 1 : 0);
      $d_dialogovalioso = (($d_foto + $d_resppreguntas + $d_hacepreguntas + $d_cuentafamcomuni + $d_mencionaproyectos) > 0 ? 1 : 0);

      $query = "replace into `c08control`    (`puserid`,      `sc`,         `no`,        `comtype`,        `duebefore`,        `fechaua`,        `p_participosc`,        `p_dibujo`,        `p_carta`,        `p_huella`,        `c_quienescribiocarta`,        `d_dialogovalioso`,        `d_foto`,        `d_resppreguntas`,        `d_hacepreguntas`,        `d_cuentafamcomuni`,        `d_mencionaproyectos`,         `i_contenidoinaprop`) "
      . "                 VALUES ('$_SESSION[userid]','$_POST[sc]', '$_POST[no]','$_POST[comtype]','$_POST[duebefore]','$_POST[fechaua]',       '$p_participosc',       '$p_dibujo',       '$p_carta',       '$p_huella','$_POST[c_quienescribiocarta]',       '$d_dialogovalioso',       '$d_foto',       '$d_resppreguntas',       '$d_hacepreguntas',       '$d_cuentafamcomuni',       '$d_mencionaproyectos', '$_POST[i_contenidoinaprop]')";
      $result = mysqli_query($link, $query);
      header("Location:c08");
}


// ELIMINAR REGISTRO
if (isset($_GET[delete])) {
      $permit=2;
      // 1 admin
      // 2 super user <<<<<<
      // 3 usuario
      // 4 visitante
      if ($_SESSION[rolid]>$permit) {
            header("Location:403");
      }
      $query = "DELETE FROM `c08todolist` WHERE concat(sc,comtype,duebefore)='$_GET[delete]'";
      $result = mysqli_query($link, $query);
      $query = "DELETE FROM `c08control` WHERE concat(sc,comtype,duebefore)='$_GET[delete]'";
      $result = mysqli_query($link, $query);
      header("Location:c08");
}


if (isset($_GET[idcomp])) {
      // $query = "select t.*, fechaua, p_participosc, p_dibujo, p_carta, p_huella, c_quienescribiocarta, d_dialogovalioso, d_foto, d_resppreguntas, d_hacepreguntas, d_cuentafamcomuni, d_mencionaproyectos, i_contenidoinaprop from c08todolist t left join c08control c on concat(t.sc,t.comtype,t.duebefore)=concat(c.sc, c.comtype, c.duebefore) "
      // . " where concat(t.sc,t.comtype,t.duebefore)='$_GET[idcomp]'";
      $idcomp = $_GET[idcomp];
      $query = "select * from generalcomms "
      . " where concat(sc,comtype,duebefore)='$idcomp'";
      $result = mysqli_query($link, $query);

      $row_cnt = mysqli_num_rows($result);
      if ($row_cnt==0) {
            header("Location:c08");
      }

      $row = mysqli_fetch_array($result);
      $fechaua=($row[fechaua]==""? date('Y-m-d') : $row[fechaua]);
      $p_dibujo = ($row[p_dibujo] == 1 ? "checked" : "");
      $p_carta = ($row[p_carta] == 1 ? "checked" : "");
      $p_huella = ($row[p_huella] == 1 ? "checked" : "");
      $d_foto = ($row[d_foto] == 1 ? "checked" : "");
      $d_resppreguntas = ($row[d_resppreguntas] == 1 ? "checked" : "");
      $d_hacepreguntas = ($row[d_hacepreguntas] == 1 ? "checked" : "");
      $d_cuentafamcomuni = ($row[d_cuentafamcomuni] == 1 ? "checked" : "");
      $d_mencionaproyectos = ($row[d_mencionaproyectos] == 1 ? "checked" : "");
}

include 'header.php';
?>



<div class="col-xs-12 col-md-12">
      <div class="panel panel-primary">
            <div class="panel-heading">
                  <h3 class="panel-title"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>REGISTRO COMUNICACIÓN</h3>
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
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>SC:</td><td><?php echo $row['sc'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>NOMBRE:</td><td><?php echo $row['scname'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>EDAD:</td><td><?php echo $row['scage'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>ON:</td><td><?php echo $row['no'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>SP:</td><td><?php echo $row['sp'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>NOMBRE:</td><td><?php echo $row['spname'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>COM:</td><td><?php echo $row['comtype'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>COMENT:</td><td><?php echo $row['comments'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>UP:</td><td><?php echo $row['puname'] ?></td></tr>
                                          <tr><td><span class="glyphicon glyphicon-paperclip text-muted"></span>FACILITA:</td><td><?php echo $row['facilita'] ?></td></tr>
                                    </tbody>
                              </table>
                        </div>
                        <div class="col-md-7">
                              <form role="form" action="c08reg" method="post"  class="form-horizontal">
                                    <div class="form-group">
                                          <div class="col-xs-3">
                                                <label for="pu">UP:</label>
                                                <input type="text" class="form-control input-sm" name="pu" value="<?php echo $row['pu']; ?>" required="required" readonly>
                                          </div>
                                          <div class="col-xs-3">
                                                <label for="sc">SC:</label>
                                                <input type="text" class="form-control input-sm" name="sc" value="<?php echo $row['sc']; ?>" required="required" readonly>
                                          </div>
                                          <div class="col-xs-6">
                                                <label for="scname">NOMBRE SC:</label>
                                                <input type="text" class="form-control input-sm" name="scname" value="<?php echo $row['scname']; ?>" required="required" readonly>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="col-xs-3">
                                                <label for="comtype">COM:</label>
                                                <input type="text" class="form-control input-sm" name="comtype" value="<?php echo $row['comtype']; ?>" required="required" readonly>
                                          </div>
                                          <div class="col-xs-3">
                                                <label for="no">ON:</label>
                                                <input type="text" class="form-control input-sm" name="no" value="<?php echo $row['no']; ?>" required="required" readonly>
                                          </div>
                                          <div class="col-xs-3">
                                                <label for="duebefore">VENCE CD:</label>
                                                <input type="date" class="form-control input-sm" name="duebefore" value="<?php echo $row['duebefore']; ?>" required="required" readonly>
                                          </div>
                                          <div class="col-xs-3">
                                                <label for="fechaua">REC UA:</label>
                                                <input type="date" class="form-control input-sm" name="fechaua" value="<?php echo $fechaua; ?>" required="required">
                                          </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                          <div class="col-xs-6">
                                                <label for="c_quienescribiocarta">QUIÉN ESCRIBIÓ LA CARTA:</label>
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
                                                <label>PARTICIPACIÓN DEL SC:</label>
                                                <div class="checkbox">
                                                      <label><input type="checkbox"  name="p_dibujo" <?php echo $p_dibujo ?>> Dibujo</label>
                                                </div>
                                                <div class="checkbox">
                                                      <label><input type="checkbox"  name="p_carta" <?php echo $p_carta ?>> Carta</label>
                                                </div>
                                                <div class="checkbox">
                                                      <label><input type="checkbox"  name="p_huella" <?php echo $p_huella ?>> Huella</label>
                                                </div>
                                          </div>

                                          <div class="col-xs-6">
                                                <label >DIÁLOGO VALIOSO:</label>
                                                <div class="checkbox">
                                                      <label><input type="checkbox"  name="d_foto" <?php echo $d_foto ?>> Incluye foto</label>
                                                </div>
                                                <div class="checkbox">
                                                      <label><input type="checkbox"  name="d_resppreguntas" <?php echo $d_resppreguntas ?>> Responde preguntas</label>
                                                </div>
                                                <div class="checkbox">
                                                      <label><input type="checkbox" name="d_hacepreguntas" <?php echo $d_hacepreguntas ?>> Hace preguntas a SP</label>
                                                </div>
                                                <div class="checkbox">
                                                      <label><input type="checkbox"  name="d_cuentafamcomuni" <?php echo $d_cuentafamcomuni ?>> Cuenta sobre su familia|comunidad</label>
                                                </div>
                                                <div class="checkbox">
                                                      <label><input type="checkbox"  name="d_mencionaproyectos" <?php echo $d_mencionaproyectos ?>> Menciona proyectos</label>
                                                </div>
                                          </div>
                                    </div>

                                    <hr>
                                    <div class="text-right">
                                          <button type="submit" class="btn btn-success" name="enviar"><span class='glyphicon glyphicon-ok'> </span>Grabar</button>
                                          <a href="c08" class="btn btn-primary"><span class='glyphicon glyphicon-remove'> </span>Cancelar</a>
                                          <a class="btn btn-default" role="button" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                <span class="glyphicon glyphicon-trash"></span>ELIMINAR
                                          </a>
                                          <div class="collapse" id="collapse1">
                                                <p class="text-danger">
                                                      <span class="glyphicon glyphicon-info-sign"></span>
                                                      SE ELIMINARA EL REGISTRO. ESTÁ SEGURO ??
                                                </p>
                                                <a href="c08reg?delete=<?php echo $idcomp?>"  class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="ELIMINAR TOTALMENTE!">
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
