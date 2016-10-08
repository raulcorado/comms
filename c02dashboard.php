
<?php
include 'secure.php';
include 'app/connection.php';

include 'header.php';
_PERMITG("comm02");
?>

<h1>Control de beneficiarios</h1>
<h4>Cuadro de mando</h4>



<div class="row">
      <div class="col-md-12">
            <div class="panel panel-danger">
                  <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-paperclip"></span>
                              ESTATUS DE UP FY 2016
                        </h3>
                  </div>
                  <div class="panel-body">
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>FY-2016</strong></h4>
                              <table class="table table-condensed table-hover table-striped table-bordered">
                                    <?php
                                    echo _TCONTENT("select puname UP, sum(if(fy16>0,1,0)) FY16, count(puname) TOT from general02control group by 1");
                                    ?>
                              </table>
                        </div>
                        <div class="col-md-4">
                              <h4 class="text-center"><strong>FY-2016</strong></h4>
                              <?php
                              $gquery = "select puname UP, sum(if(fy16>0,1,0)) FY16, count(puname)-sum(if(fy16>0,1,0)) PENDIENTE from general02control group by 1";
                              // $pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
                              $pattern="'#7fb800','#0d2c54','#ffb400'";
                              $data=_SERIAL($gquery, "UP", "est", 0);
                              _CHART($data[0], $data[1], "UP", "bar", $pattern);
                              ?>
                        </div>
                        <div class="col-md-4">
                             <h4 class="text-center"><strong>GENERAL FY-2016</strong></h4>
                             <?php
                             $gquery = "select 'TOTAL' TOTAL, sum(if(fy16>0,1,0)) CUMPLE, count(puname)-sum(if(fy16>0,1,0)) PENDIENTE from general02control group by 1";
                             // $pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
                             $pattern="'#7fb800','#0d2c54','#ffb400'";
                             $data=_SERIAL($gquery, "TOTAL", "est", 0);
                             _CHART($data[0], $data[1], "TOTAL", "pie", $pattern);
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
                              ESTATUS DE UP FY 2017
                        </h3>
                  </div>
                  <div class="panel-body">


                        <div class="col-md-4">
                             <h4 class="text-center"><strong>FY-2017</strong></h4>
                             <table class="table table-condensed table-hover table-striped table-bordered">
                                   <?php

                                   echo _TCONTENT("select puname UP, sum(if(fy17>0,1,0)) FY17, count(puname) TOT from general02control group by 1");
                                   ?>
                             </table>
                       </div>
                       <div class="col-md-4">
                             <h4 class="text-center"><strong>FY-2017</strong></h4>
                             <?php
                             $gquery = "select puname UP, sum(if(fy17>0,1,0)) FY17, count(puname)-sum(if(fy17>0,1,0)) PENDIENTE from general02control group by 1";
                             // $pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
                             $pattern="'#7fb800','#0d2c54','#ffb400'";
                             $data=_SERIAL($gquery, "UP", "est", 0);
                             _CHART($data[0], $data[1], "UP", "bar", $pattern);
                             ?>
                       </div>
                       <div class="col-md-4">
                            <h4 class="text-center"><strong>GENERAL FY-2017</strong></h4>
                            <?php
                            $gquery = "select 'TOTAL' TOTAL, sum(if(fy17>0,1,0)) CUMPLE, count(puname)-sum(if(fy17>0,1,0)) PENDIENTE from general02control group by 1";
                            // $pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
                            $pattern="'#7fb800','#0d2c54','#ffb400'";
                            $data=_SERIAL($gquery, "TOTAL", "est", 0);
                            _CHART($data[0], $data[1], "TOTAL", "pie", $pattern);
                            ?>
                     </div>
                  </div>

            </div>
      </div>
</div>


<?php
include 'footer.php';
?>
