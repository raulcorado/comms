
<?php
include 'secure.php';
include 'app/connection.php';



if (isset($_POST[enviar])) {
      $_SESSION[mes] = $_POST[mes];
      //  header("Location:c08");
}


include 'header.php';
_PERMITG("comm08");
?>

<h1>Control de correspondencia</h1>
<h4>Cuadro de mando</h4>

<div class="col-xs-2">
      <form role="form" action="c08dashboard" method="post"  class="form-horizontal">
            <div class="form-group">
                  <label for="enviar">MES:</label>
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
                              <label for="enviar">YYYY-MM</label>
                              <button type="submit" name="enviar" class="btn btn-sm input-sm btn-success" type="button"><span class='glyphicon glyphicon-refresh'></span></button>
                        </span>
                  </div>
            </div>
      </form>
</div>

<div class="row">
      <div class="col-md-12">
            <div class="panel panel-primary">
                  <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-paperclip"></span>
                              ESTATUS DE CARTAS
                        </h3>
                  </div>
                  <div class="panel-body">
                        <div class="col-md-6">                           
                              <h4 class="text-center"><strong>ESTATUS DE CARTAS</strong></h4>
                              <table class="table table-condensed table-hover table-striped table-bordered">
                                    <?php
                                    echo _TCONTENT(_CROSS("select puname `UP`, est from generalcomms where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'", "UP", "est", 1));
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-6">
                              <h4 class="text-center"><strong>ESTATUS DE CARTAS</strong></h4>
                              <?php
                              $gquery = "select puname, est from generalcomms where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
                              $pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
                              $data=_SERIAL($gquery, "puname", "est", 1);
                              _CHART($data[0], $data[1], "puname", "bar", $pattern);
                              ?>
                        </div>
                  </div>

            </div>
      </div>
</div>
<br>

<div class="row">
      <div class="col-md-12">
            <div class="panel panel-primary">
                  <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-paperclip"></span>
                              PARTICIPACION DEL SC
                        </h3>

                  </div>
                  <div class="panel-body">
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>PARTICIPACION DEL SC</strong></h4>
                              <table class="table table-condensed table-hover table-striped table-bordered">
                                    <?php
                                    echo _TCONTENT(_CROSS("select puname `UP`, p_participosc `PARTICIPO_SC` from generalcontrol where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'", "UP", "PARTICIPO_SC", 1));
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>PARTICIPACION DEL SC</strong></h4>
                              <?php
                              $gquery = "select puname `UP`, p_participosc from generalcontrol where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
                              $data=_SERIAL($gquery, "UP", "p_participosc", 1);
                              _CHART($data[0], $data[1], "UP", "bar", $pattern);
                              ?>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>DETALLE</strong></h4>
                              <?php
                              $gquery = "select puname `UP`, sum(p_dibujo) DIBUJO, sum(p_carta) CARTA, sum(p_huella) HUELLA from generalcontrol where date_format(duebefore,'%Y-%m')='$_SESSION[mes]' group by 1";
                              $data=_SERIAL($gquery, "UP", "", 0);
                              _CHART($data[0], $data[1], "UP", "bar", $pattern);
                              ?>
                        </div>
                  </div>
            </div>
      </div>
</div>
<br>

<div class="row">
      <div class="col-md-12">
            <div class="panel panel-primary">
                  <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-paperclip"></span>
                              DIALOGO VALIOSO
                        </h3>

                  </div>
                  <div class="panel-body">
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>DIALOGO VALIOSO</strong></h4>
                              <table class="table table-condensed table-hover table-striped table-bordered">
                                    <?php
                                    echo _TCONTENT(_CROSS("select puname `UP`, d_dialogovalioso from generalcontrol  where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'", "UP", "d_dialogovalioso", 1));
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>DIALOGO VALIOSO</strong></h4>
                              <?php
                              $gquery = "select puname `UP`, d_dialogovalioso from generalcontrol where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
                              $pattern="'#6699cc','#ff8c42','#ff3c38','#a23e48','#fff275'";
                              $data=_SERIAL($gquery, "UP", "d_dialogovalioso", 1);
                              _CHART($data[0], $data[1], "UP", "bar", $pattern);
                              ?>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>DETALLE</strong></h4>
                              <?php
                              $gquery = "select puname `UP`, sum(d_foto) FOTO, sum(d_resppreguntas) RESP_PREGUNTAS, sum(d_hacepreguntas) HACE_PREGUNTAS, sum(d_cuentafamcomuni) CUENTA_FAM_COMUNI, sum(d_mencionaproyectos) MENCIONA_PROY   from generalcontrol where date_format(duebefore,'%Y-%m')='$_SESSION[mes]' group by 1";
                              $pattern="'#6699cc','#ff8c42','#ff3c38','#a23e48','#fff275'";
                              $data=_SERIAL($gquery, "UP", "", 0);
                              _CHART($data[0], $data[1], "UP", "bar", $pattern);
                              ?>
                        </div>
                  </div>
            </div>
      </div>
</div>
<br>
<div class="row">
      <div class="col-md-12">
            <div class="panel panel-primary">
                  <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-paperclip"></span>
                              QUIEN ESCRIBE LA CARTA
                        </h3>

                  </div>
                  <div class="panel-body">
                        <div class="col-md-8">
                              <h4 class="text-center"><strong>QUIEN ESCRIBE LA CARTA</strong></h4>
                              <table class="table table-condensed table-hover table-striped table-bordered">
                                    <?php
                                    echo _TCONTENT(_CROSS("select puname `UP`, c_quienescribiocarta from generalcontrol  where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'", "UP", "c_quienescribiocarta", 1));
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>QUIEN ESCRIBE LA CARTA</strong></h4>
                              <?php
                              $gquery = "select puname `UP`, c_quienescribiocarta from generalcontrol where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
                              $pattern="'#4d9de0','#e15554','#e1bc29','#3bb273','#7768ae'";
                              $data=_SERIAL($gquery, "UP", "c_quienescribiocarta", 1);
                              _CHART($data[0], $data[1], "UP", "bar", $pattern);
                              ?>
                        </div>

                        <div class="col-md-4">
                              <h4 class="text-center"><strong>CONTENIDO INAPROPIADO</strong></h4>
                              <?php
                              $gquery = "select puname `UP`, i_contenidoinaprop from generalcontrol where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
                              $pattern="'#541388','#d90368','#f1e9da','#2e294e','#ffd400'";
                              $data=_SERIAL($gquery, "UP", "i_contenidoinaprop", 1);
                              _CHART($data[0], $data[1], "UP", "bar", $pattern);
                              ?>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>CONTENIDO INAPROPIADO</strong></h4>
                              <table class="table table-condensed table-hover table-striped table-bordered">
                                    <?php
                                    echo _TCONTENT(_CROSS("select puname `UP`, i_contenidoinaprop from generalcontrol  where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'", "UP", "i_contenidoinaprop", 1));
                                    ?>
                              </table>
                        </div>
                  </div>
            </div>
      </div>
</div>

<br>
<div class="row">
      <div class="col-md-12">
            <div class="panel panel-primary">
                  <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-paperclip"></span>
                              REPORTE FACILITADOR
                        </h3>

                  </div>
                  <div class="panel-body">
                        <div class="col-md-12">
                              <h4><strong>REPORTE FACILITADOR</strong></h4>
                              <hr>
                              <?php
                              $query = "select puname from generalcomms group by 1";
                              $result1 = mysqli_query($link, $query);
                              mysqli_data_seek($result, 0);
                              while ($row1 = mysqli_fetch_array($result1)) {
                                    ?>
                                    <h4><span class="glyphicon glyphicon-paperclip"></span><?php echo strtoupper($row1[puname])?> </h4>
                                    <table class="table table-condensed table-hover table-striped table-bordered table-responsive">
                                          <?php
                                          echo _TCONTENT(_CROSS("select left(facilita,20) FDC, est from generalcomms where date_format(duebefore,'%Y-%m')='$_SESSION[mes]' and puname='" . $row1[puname] . "'", "FDC", "est", 1));
                                          ?>
                                    </table>
                                    <br>
                                    <?php
                              }
                              ?>
                        </div>
                  </div>

            </div>
      </div>
</div>
<br>


<?php
include 'footer.php';
?>
