
<?php
include 'secure.php';
include 'app/connection.php';

include 'header.php';
_PERMITG("comm10");
?>

<h1>Control de calidad de cartas FWL</h1>
<h4>Cuadro de mando</h4>

<div class="row">
     <div class="col-xs-2">
          <form role="form" action="c10" method="post"  class="form-horizontal">
               <!-- <label for="enviar">MES:</label> -->
               <div class="input-group">
                    <select data-style="btn-info" class="form-control input-sm" name="mes" required="required">
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
     </div>
</div>
<br>


<div class="row">
     <div class="col-md-12">
          <div class="panel panel-info">
               <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-paperclip"></span>
                         Control de calidad FWL
                    </h3>
               </div>
               <div class="panel-body">
                    <div class="col-md-4">
                         <h4 class="text-center"><strong>Control de calidad FWL</strong></h4>
                         <table class="table table-condensed table-hover table-striped table-bordered">
                              <?php
                              //  echo _TCONTENT("select puname UP, sum(if(fy16>0,1,0)) FY16, count(puname) TOT from general02control group by 1");
                              ?>
                         </table>
                    </div>

                    <div class="col-md-4">
                         <h4 class="text-center"><strong>GENERAL</strong></h4>
                         <?php
                         $gquery = "SELECT 'TOTAL' TOTAL, count(fechaua) INGRESADO, count(1)-count(fechaua) PENDIENTE FROM comms.c10control";
                         // $pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
                         $pattern="'#7fb800','#0d2c54','#ffb400'";
                         $data=_SERIAL($gquery, "TOTAL", "","",0);
                         _CHART($data[0], $data[1], "TOTAL", "pie", $pattern);
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
