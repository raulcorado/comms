
<?php
include 'secure.php';
include 'connection.php';



if (isset($_POST[enviar])) {
      $_SESSION[mes] = $_POST[mes];
      $_SESSION[filtro]="where date_format(duebefore,'%Y-%m')='$_SESSION[mes]'";
      //  header("Location:c08");
}


include 'header.php';
?>

<h1>Cuadro de mando</h1>
<h4>CARTAS</h4>
<hr>
<div class="col-xs-2 col-xs-offset-10">
      <form role="form" action="c08dashboard" method="post"  class="form-horizontal">
            <div class="form-group">
                  <label for="enviar">MES:</label>
                  <div class="input-group">
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
                              <button type="submit" name="enviar" class="btn btn-sm btn-success" type="button"><span class='glyphicon glyphicon-ok'></span></button>
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
                                    $gquery="select puname `UP`, est from generalcomms " . $_SESSION[filtro];
                                    $field1="UP";
                                    $field2="est";
                                    $tot=1; //columna totales
                                    include 'fnc/cross.php';
                                    include 'fnc/tcontent.php';
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-6">
                              <h4 class="text-center"><strong>ESTATUS DE CARTAS</strong></h4>
                              <?php
                              $id="g01";
                              // SERIAL INICIO
                              $gquery = "select puname, est from generalcomms " . $_SESSION[filtro];
                              $field1 = "puname";
                              $field2 = "est";
                              include 'fnc/serial.php';
                              // SERIAL FINAL
                              $pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
                              include "gbar.php";
                              ?>
                        </div>
                  </div>

            </div>
      </div>
</div>
<br>

<div class="row">
      <div class="col-md-12">
            <div class="panel panel-success">
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
                                    // CROSS INICIO
                                    $gquery="select puname `UP`, p_participosc `PARTICIPO_SC` from generalcontrol " . $_SESSION[filtro];
                                    $field1="UP";
                                    $field2="PARTICIPO_SC";
                                    $tot=1; //columna totales
                                    include 'fnc/cross.php';
                                    // CROSS FINAL
                                    //TCONTENT INICIO
                                    include 'fnc/tcontent.php';
                                    //TCONTENT FINAL
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>PARTICIPACION DEL SC</strong></h4>
                              <?php
                              $id="g02";
                              // SERIAL INICIO
                              $gquery = "select puname `UP`, p_participosc from generalcontrol " . $_SESSION[filtro];
                              $field1 = "UP";
                              $field2 = "p_participosc";
                              include 'fnc/serial.php';
                              // SERIAL FINAL
                              include "gbar.php";
                              ?>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>DETALLE</strong></h4>
                              <?php
                              $id="g03";
                              //S-SERIAL INICIO
                              $gquery = "select puname `UP`, sum(p_dibujo) DIBUJO, sum(p_carta) CARTA, sum(p_huella) HUELLA from generalcontrol " . $_SESSION[filtro] . " group by 1";
                              $field1 = "UP";
                              include 'fnc/sserial.php';
                              //S-SERIAL FINAL
                              include "gbar.php";
                              ?>
                        </div>
                  </div>
            </div>
      </div>
</div>
<br>

<div class="row">
      <div class="col-md-12">
            <div class="panel panel-warning">
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
                                    // CROSS INICIO
                                    $gquery="select puname `UP`, d_dialogovalioso from generalcontrol  " . $_SESSION[filtro];
                                    $field1="UP";
                                    $field2="d_dialogovalioso";
                                    $tot=1; //columna totales
                                    include 'fnc/cross.php';
                                    // CROSS FINAL
                                    //TCONTENT INICIO
                                    include 'fnc/tcontent.php';
                                    //TCONTENT FINAL
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>DIALOGO VALIOSO</strong></h4>
                              <?php
                              $id="g04";
                              // SERIAL INICIO
                              $gquery = "select puname `UP`, d_dialogovalioso from generalcontrol " . $_SESSION[filtro];
                              $field1 = "UP";
                              $field2 = "d_dialogovalioso";
                              include 'fnc/serial.php';
                              // SERIAL FINAL
                              $pattern="'#6699cc','#ff8c42','#ff3c38','#a23e48','#fff275'";
                              include "gbar.php";
                              ?>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>DETALLE</strong></h4>
                              <?php
                              $id="g05";
                              //S-SERIAL INICIO
                              $gquery = "select puname `UP`, sum(d_foto) FOTO, sum(d_resppreguntas) RESP_PREGUNTAS, sum(d_hacepreguntas) HACE_PREGUNTAS, sum(d_cuentafamcomuni) CUENTA_FAM_COMUNI, sum(d_mencionaproyectos) MENCIONA_PROY   from generalcontrol " . $_SESSION[filtro] . " group by 1";
                              $field1 = "UP";
                              include 'fnc/sserial.php';
                              //S-SERIAL FINAL
                              $pattern="'#6699cc','#ff8c42','#ff3c38','#a23e48','#fff275'";
                              include "gbar.php";
                              ?>
                        </div>
                  </div>
            </div>
      </div>
</div>
<br>
<div class="row">
      <div class="col-md-12">
            <div class="panel panel-danger">
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
                                    // CROSS INICIO
                                    $gquery="select puname `UP`, c_quienescribiocarta from generalcontrol  " . $_SESSION[filtro];
                                    $field1="UP";
                                    $field2="c_quienescribiocarta";
                                    $tot=1; //columna totales
                                    include 'fnc/cross.php';
                                    // CROSS FINAL
                                    //TCONTENT INICIO
                                    include 'fnc/tcontent.php';
                                    //TCONTENT FINAL
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>QUIEN ESCRIBE LA CARTA</strong></h4>
                              <?php
                              $id="g06";
                              // SERIAL INICIO
                              $gquery = "select puname `UP`, c_quienescribiocarta from generalcontrol " . $_SESSION[filtro];
                              $field1 = "UP";
                              $field2 = "c_quienescribiocarta";
                              include 'fnc/serial.php';
                              // SERIAL FINAL
                              $pattern="'#4d9de0','#e15554','#e1bc29','#3bb273','#7768ae'";
                              include "gbar.php";
                              ?>
                        </div>

                        <div class="col-md-4">
                              <h4 class="text-center"><strong>CONTENIDO INAPROPIADO</strong></h4>
                              <?php
                              $id="g07";
                              // SERIAL INICIO
                              $gquery = "select puname `UP`, i_contenidoinaprop from generalcontrol " . $_SESSION[filtro];
                              $field1 = "UP";
                              $field2 = "i_contenidoinaprop";
                              include 'fnc/serial.php';
                              // SERIAL FINAL
                              $pattern="'#541388','#d90368','#f1e9da','#2e294e','#ffd400'";
                              include "gbar.php";
                              ?>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>CONTENIDO INAPROPIADO</strong></h4>
                              <table class="table table-condensed table-hover table-striped table-bordered">
                                    <?php
                                    // CROSS INICIO
                                    $gquery="select puname `UP`, i_contenidoinaprop from generalcontrol  " . $_SESSION[filtro];
                                    $field1="UP";
                                    $field2="i_contenidoinaprop";
                                    $tot=1; //columna totales
                                    include 'fnc/cross.php';
                                    // CROSS FINAL
                                    //TCONTENT INICIO
                                    include 'fnc/tcontent.php';
                                    //TCONTENT FINAL
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
            <div class="panel panel-info">
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
                                          // CROSS INICIO
                                          $gquery="select left(facilita,20) FDC, est from generalcomms " . $_SESSION[filtro] . " and puname='" . $row1[puname] . "'";
                                          $field1="FDC";
                                          $field2="est";
                                          $tot=1; //columna totales
                                          include 'fnc/cross.php';
                                          // CROSS FINAL
                                          //TCONTENT INICIO
                                          include 'fnc/tcontent.php';
                                          //TCONTENT FINAL
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