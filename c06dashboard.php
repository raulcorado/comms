
<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';



if (isset($_POST[enviar])) {
     $_SESSION[mes] = $_POST[mes];
     //  header("Location:c08");
}


include 'header.php';
_PERMITG("comm06a,comm06p,comm06u,comm06v");
?>

<h1>Control de cartas de bienvenida</h1>
<h4>Cuadro de mando</h4>

<div class="col-xs-2">
     <form role="form" action="c06dashboard" method="post"  class="form-horizontal">
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
                         CARTAS DE BIENVENIDA
                    </h3>
               </div>
               <div class="panel-body">
                    <div class="col-md-4">
                         <h4 class="text-center"><strong>TABLA POR AÑO Y TRIMESTRE</strong></h4>
                         <table class="table table-condensed table-hover table-striped table-bordered">
                              <?php
                              echo _TCONTENT("select concat(quarter(mes),' - ',year(mes)) TRIM, sum(respuestas) COMPLETO, sum(detotal-respuestas) PENDIENTE, sum(detotal) TOTAL from general06total group by 1");
                              ?>
                         </table>
                    </div>
                    <div class="col-md-4">
                         <h4 class="text-center"><strong>CANTIDAD</strong></h4>
                         <?php
                         $gquery = "select concat('Q',quarter(mes),'-',year(mes)) TRIM, sum(respuestas) COMPLETO, sum(detotal-respuestas) as PENDIENTE from general06total group by 1";
                         $pattern="'#007fff','#364c56'";
                         $data=_SERIAL($gquery, "TRIM", "COMPLETO");
                         _CHART($data[0], $data[1], "TRIM", "bar", $pattern);
                         ?>
                    </div>
                    <div class="col-md-4">
                         <h4 class="text-center"><strong>%</strong></h4>
                         <?php
                         $gquery = "select concat('Q',quarter(mes),'-',year(mes)) TRIM, sum(respuestas)/sum(detotal)*100 COMPLETO, sum(detotal-respuestas)*100/sum(detotal) as PENDIENTE from general06total group by 1";
                         $pattern="'#007fff','#364c56'";
                         $data=_SERIAL($gquery, "TRIM", "COMPLETO");
                         _CHART($data[0], $data[1], "TRIM", "bar", $pattern);
                         ?>
                    </div>
               </div>

          </div>
     </div>
</div>


<?php
$queryu = "select * from generallocationup";
$resultu = mysqli_query($link, $queryu);
mysqli_data_seek($resultu, 0);
while ($rowd = mysqli_fetch_array($resultu)) {
     ?>
     <br>
     <div class="row">
          <div class="col-md-12">
               <div class="panel panel-primary">
                    <div class="panel-heading">
                         <h3 class="panel-title"><span class="glyphicon glyphicon-paperclip"></span>
                              CARTAS DE BIENVENIDA
                         </h3>
                    </div>
                    <div class="panel-body">
                         <h4><strong><?php echo $rowd['nombre1'] ?></strong></h4>
                         <hr>
                         <div class="col-md-4">
                              <h4 class="text-center"><strong>TABLA POR AÑO Y TRIMESTRE</strong></h4>
                              <table class="table table-condensed table-hover table-striped table-bordered">
                                   <?php
                                   echo _TCONTENT("select concat(quarter(mes),' - ',year(mes)) TRIM, sum(respuestas) COMPLETO, sum(detotal-respuestas) PENDIENTE, sum(detotal) TOTAL from general06total where pucode='$rowd[cod1]' group by 1");
                                   ?>
                              </table>
                         </div>
                         <div class="col-md-4">
                              <h4 class="text-center"><strong>CANTIDAD</strong></h4>
                              <?php
                              $gquery = "select concat('Q',quarter(mes),'-',year(mes)) TRIM, sum(respuestas) COMPLETO, sum(detotal-respuestas) as PENDIENTE from general06total where pucode='$rowd[cod1]' group by 1";
                              $pattern="'#007fff','#364c56'";
                              $data=_SERIAL($gquery, "TRIM", "COMPLETO");
                              _CHART($data[0], $data[1], "TRIM", "bar", $pattern);
                              ?>
                         </div>
                         <div class="col-md-4">
                              <h4 class="text-center"><strong>%</strong></h4>
                              <?php
                              $gquery = "select concat('Q',quarter(mes),'-',year(mes)) TRIM, sum(respuestas)/sum(detotal)*100 COMPLETO, sum(detotal-respuestas)*100/sum(detotal) as PENDIENTE from general06total where pucode='$rowd[cod1]' group by 1";
                              $pattern="'#007fff','#364c56'";
                              $data=_SERIAL($gquery, "TRIM", "COMPLETO");
                              _CHART($data[0], $data[1], "TRIM", "bar", $pattern);
                              ?>
                         </div>
                    </div>

               </div>
          </div>
     </div>





     <?php
}
?>

<?php
include 'footer.php';
?>
