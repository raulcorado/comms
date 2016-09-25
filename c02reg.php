<?php
include 'secure.php';
include 'app/connection.php';



if (isset($_POST[enviar])) {
     $fields = "";
     $values1 = "";
     $values2 = "";
     for ($c=7; $c <= 11; $c++) {
          for ($a=1; $a <= 8; $a++) {
               ${"cp" . $c . "_" . $a}  = (isset($_POST["cp" . $c . "_" . $a]) ? 1 : 0);
               ${"ccp" . $c . "_" . $a}  = (isset($_POST["ccp" . $c . "_" . $a]) ? 1 : 0);
               $fields = $fields . ", `cp$c" . "_" . $a . "`";
               $values1 = $values1 . ", '" . ${"cp" . $c . "_" . $a} . "'";
               $values2 = $values2 . ", '" . ${"ccp" . $c . "_" . $a} . "'";
          }
     }
     $query= "replace into `c02control` (`userid`,            `fy`,         `locationtagid`,          `obs`     $fields) "
     . "                         VALUES ('$_SESSION[userid]', '2016', '$_POST[locationtagid]', '$_POST[obs1]'  $values1)";
     $result = mysqli_query($link, $query);


     $query= "replace into `c02control` (`userid`,            `fy`,         `locationtagid`,          `obs`    $fields) "
     . "                         VALUES ('$_SESSION[userid]', '2017', '$_POST[locationtagid]', '$_POST[obs2]' $values2)";
     $result = mysqli_query($link, $query);

     header("Location:c02");
}



if (isset($_GET[comm])) {
     // $query = "select t.*, fechaua, p_participosc, p_dibujo, p_carta, p_huella, c_quienescribiocarta, d_dialogovalioso, d_foto, d_resppreguntas, d_hacepreguntas, d_cuentafamcomuni, d_mencionaproyectos, i_contenidoinaprop from c08todolist t left join c08control c on concat(t.sc,t.comtype,t.duebefore)=concat(c.sc, c.comtype, c.duebefore) "
     // . " where concat(t.sc,t.comtype,t.duebefore)='$_GET[idcomp]'";
     $query = "select * from general02list where (`locationtagid`='$_GET[comm]') and (`pucod`='$_SESSION[depto]')";
     $result = mysqli_query($link, $query);
     $row_cnt = mysqli_num_rows($result);
     $row = mysqli_fetch_array($result);
     // echo "$query";

     $query = "select * from general02list where (`locationtagid`='$_GET[comm]') and (`fy`='2016') and (`pucod`='$_SESSION[depto]')";
     $result1 = mysqli_query($link, $query);
     $row_cnt1 = mysqli_num_rows($result1);
     $row1 = mysqli_fetch_array($result1);
     // echo "$query";

     $query = "select * from general02list where (`locationtagid`='$_GET[comm]') and (`fy`='2017') and (`pucod`='$_SESSION[depto]')";
     $result2 = mysqli_query($link, $query);
     $row_cnt2 = mysqli_num_rows($result2);
     $row2 = mysqli_fetch_array($result2);
     // echo "$query";
}

include 'header.php';
_PERMITG("comm02");



$areas = array(
     "1. DESARROLLO SALUDABLE DESDE LA PRIMERA INFANCIA",
     "2. SALUD SEXUAL Y REPRODUCTIVA",
     "3. EDUCACIÓN",
     "4. AGUA Y SANEAMIENTO",
     "5. SEGURIDAD ECONÓMICA",
     "6. PROTECCIÓN",
     "7. PARTICIPAR COMO CIUDADANOS",
     "8. PROTECCIÓN ANTE EMERGENCIAS"
);
?>


<h1>Monitoreo de proyectos</h1>
<h4>Monitoreo de proyectos de la comunidad</h4>


<div class="panel panel-danger">
     <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>MONITOREO DE LA COMUNIDAD</h3>
     </div>
     <div class="panel-body">

          <div class="col-md-12">
               <form role="form" action="c02reg" method="post"  class="form-horizontal">
                    <input type="hidden" name="locationtagid" value="<?php echo $row['locationtagid']; ?>" required="required" readonly>

                    <div class="form-group">
                         <div class="col-xs-2">
                              <label for="cod">COD:</label>
                              <input type="text" class="form-control input-sm" value="<?php echo ($row['pucod'].'-'.$row['areacode'].'-'.$row['comcode'])?>" required="required" readonly>
                         </div>
                         <div class="col-xs-2">
                              <label for="pu">UP:</label>
                              <input type="text" class="form-control input-sm" name="puname" value="<?php echo $row['puname']; ?>" required="required" readonly>
                         </div>
                         <div class="col-xs-3">
                              <label for="area">ÁREA:</label>
                              <input type="text" class="form-control input-sm" name="areaname" value="<?php echo $row['areaname']; ?>" required="required" readonly>
                         </div>
                         <div class="col-xs-5">
                              <label for="comunidad">COMUNIDAD:</label>
                              <input type="text" class="form-control input-sm" name="comname" value="<?php echo $row['comname']; ?>" required="required" readonly>
                         </div>
                    </div>

                    <hr>
                    <div class="form-group">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <div class="col-xs-4">
                                        <label for="cod">FY:</label>
                                        <input type="text" class="form-control input-sm" value="2016" required="required" readonly>
                                   </div>
                                   <div class="col-xs-8">
                                        <label for="cod">OBSERVACIONES:</label>
                                        <input type="text" class="form-control input-sm" name="obs1" value="<?php echo $row1['obs']; ?>">
                                   </div>
                              </div>
                              <table class="table table-hover table-condensed table-bordered">
                                   <thead>
                                        <tr>
                                             <th>AREA DE IMPACTO</th>
                                             <!-- <th>CP01</th>
                                             <th>CP02</th>
                                             <th>CP03</th>
                                             <th>CP04</th>
                                             <th>CP05</th>
                                             <th>CP06</th> -->
                                             <th>CP07</th>
                                             <th>CP08</th>
                                             <th>CP09</th>
                                             <th>CP10</th>
                                             <th>CP11</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php
                                        $cp7 ='a1 a4 a5';
                                        $cp8 ='a3 a4 a5 a6 a8';
                                        $cp9 ='a2 a3 a5 a6';
                                        $cp10='a7';
                                        $cp11='a8';

                                        for ($a=0; $a <= 7; $a++) {


                                             ?>
                                             <tr>
                                                  <td><?php echo $areas[$a] ?>
                                                  </td>
                                                  <?php for ($c=7; $c <=11 ; $c++) {
                                                       $cpname = "cp$c" . "_" . ($a+1);
                                                       $chk    = ($row1[$cpname] == 1 ? "checked" : "");
                                                       $hid    = (strpos(${"cp$c"}, 'a'.($a+1)) === false ? "hidden" : "checkbox");
                                                       ?>
                                                       <td>
                                                            <input type="<?php echo $hid ?>"  name="<?php echo $cpname ?>" <?php echo $chk ?>>
                                                       </td>
                                                       <?php
                                                  }
                                                  ?>
                                             </tr>
                                             <?php
                                        }
                                        ?>
                                   </tbody>
                              </table>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <div class="col-xs-4">
                                        <label for="cod">FY:</label>
                                        <input type="text" class="form-control input-sm" value="2017" required="required" readonly>
                                   </div>
                                   <div class="col-xs-8">
                                        <label for="cod">OBSERVACIONES:</label>
                                        <input type="text" class="form-control input-sm" name="obs2" value="<?php echo $row2['obs']; ?>">
                                   </div>
                              </div>
                              <table class="table table-hover table-condensed table-bordered">
                                   <thead>
                                        <tr>
                                             <th>AREA DE IMPACTO</th>
                                             <!-- <th>CP01</th>
                                             <th>CP02</th>
                                             <th>CP03</th>
                                             <th>CP04</th>
                                             <th>CP05</th>
                                             <th>CP06</th> -->
                                             <th>CP07</th>
                                             <th>CP08</th>
                                             <th>CP09</th>
                                             <th>CP10</th>
                                             <th>CP11</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php
                                        // $cp7 ='a1 a4';
                                        // $cp8 ='a3 a4 a6';
                                        // $cp9 ='a2 a3 a5 a6';
                                        // $cp10='a7';
                                        // $cp11='a8';
                                        $cp7 ='a1 a4 a5';
                                        $cp8 ='a3 a4 a5 a6 a8';
                                        $cp9 ='a2 a3 a5 a6';
                                        $cp10='a7';
                                        $cp11='a8';

                                        for ($a=0; $a <= 7; $a++) {


                                             ?>
                                             <tr>
                                                  <td><?php echo $areas[$a] ?>
                                                  </td>
                                                  <?php for ($c=7; $c <=11 ; $c++) {
                                                       $cpname = "cp$c" . "_" . ($a+1);
                                                       $chk    = ($row2[$cpname] == 1 ? "checked" : "");
                                                       $hid    = (strpos(${"cp$c"}, 'a'.($a+1)) === false ? "hidden" : "checkbox");
                                                       ?>
                                                       <td>
                                                            <input type="<?php echo $hid ?>"  name="<?php echo "c".$cpname ?>" <?php echo $chk ?>>
                                                       </td>
                                                       <?php
                                                  }
                                                  ?>
                                             </tr>
                                             <?php
                                        }
                                        ?>
                                   </tbody>
                              </table>
                         </div>

                    </div>
                    <hr>
                    <div class="text-right">
                         <button type="submit" class="btn btn-success" name="enviar"><span class='glyphicon glyphicon-ok'> </span>Grabar</button>
                         <a href="c02" class="btn btn-primary"><span class='glyphicon glyphicon-remove'> </span>Cancelar</a>
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










<?php include 'footer.php'; ?>
