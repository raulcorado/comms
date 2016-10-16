<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';

$msg = "";


if (isset($_POST['seguimiento'])) {
     _PERMITG("comm03a,comm03p,comm03u");
     $fechareg = date('Y-m-d');
     if ($_POST['idseg'] > 0) {
          $query = "update c03seguimiento SET `fecha` = '$_POST[fecha]', `desc` = '$_POST[desc]', `visitaacasa` = $_POST[visitaacasa] WHERE `idseg` = '$_POST[idseg]'";
     } else {
          $query = "insert into c03seguimiento (`id`,`fecha`,`desc`,`area`,`visitaacasa`) VALUES ('$_SESSION[id]','$_POST[fecha]','$_POST[desc]','$_POST[area]','$_POST[visitaacasa]')";
     }
     $result = mysqli_query($link, $query);



     // if (!$result) {
     //      $msg = "Ocurrio un problema al agregar los datos";
     // } else {
     //      $msg = "El registro se almacenó correctamente";
     //      $msg = $query;
     // }
     //
     //
     header("location:c03casoss?id=$_SESSION[id]");
}

if (isset($_POST['cerrarcaso'])) {
     _PERMITG("comm03a,comm03p,comm03u");
     $fechareg = date('Y-m-d');

     $query = "update c03boletas SET estatusfecha='$_POST[estatusfecha]', idestatus = '$_POST[idestatus]'  WHERE `id` ='$_SESSION[id]'";



     $result = mysqli_query($link, $query);


     //    if (!$result) {
     //        $msg = "Ocurrio un problema al agregar los datos";
     //    } else {
     //            $msg = "El registro se almacenó correctamente";
     //            $msg = $query;
     //    }


     // echo "$query";
     header("location:c03casoss?id=$_SESSION[id]");
}

if (isset($_GET[id])) {

     $_SESSION['nuevo'] = FALSE;
     $query = "select * from c03seguimiento s left join c03boletas b on s.id=b.id left join scactive a on b.sc=`a`.`sc number` where s.id='$_GET[id]' order by s.fecha desc";
     $query = "select * from c03boletas b left join scactive a on b.sc=a.`sc number` left join c03seguimiento s on b.id=s.id where b.id='$_GET[id]' order by b.id desc";
     $result = mysqli_query($link, $query);
     $rowsc = mysqli_fetch_array($result);

     $id = $_GET[id];
     $_SESSION[id] = $id;
     $sc = $rowsc['SC Number'];
     $idestatus = $rowsc['idestatus'];
     $fecha = date("Y-m-d");
     $desc = "";
     $fdc = "";
     $idseg = "";
     $visitaacasa = -1;
}

include 'header.php';
_PERMITG("comm03a,comm03p,comm03u,comm03v");
?>




<script type="text/javascript">
$(document).ready(function () {

     $("#cerrarcaso").hide();
     $("#idestatus").change(function () {
          if ($('#idestatus').val() == '<?php echo $idestatus ?>') {
               $("#cerrarcaso").hide(300);
          } else {
               $("#cerrarcaso").show(300);
          }


     });
});

</script>



<div class="container-fluid">
     <div class="row">
          <div class="col-xs-12">

               <h1>Seguimiento</h1>
               <br />


               <div class="col-xs-8">
                    <div class="panel panel-warning">
                         <div class="panel-heading"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>SEGUIMIENTO</div>
                         <div class="panel-body">

                              <form role="form" action="c03casoss" method="post" class="form-horizontal" id="frmpago">
                                   <div class="form-group">
                                        <div class="col-xs-1">
                                             <label for = "idseg">ID:</label>
                                             <input type = "text" id="idseg" name="idseg" class="form-control input-sm" value="<?php echo $idseg ?>" readonly>
                                        </div>

                                        <div class="col-xs-3">
                                             <label for = "fecha">AÑO-MES-DÍA:</label>
                                             <input type = "date" id="fecha" name="fecha" class="form-control input-sm" value="<?php echo $fecha ?>">
                                        </div>
                                        <div class="col-xs-3">
                                             <label for = "visitaacasa" class="text-danger">VISITÓ?:</label>
                                             <select class="form-control input-sm" id="visitaacasa" name="visitaacasa" required="required">
                                                  <option value="" selected>seleccione</option>
                                                  <option value=1 <?php echo ($visitaacasa == 1 ? "selected" : "") ?>>SI</option>
                                                  <option value=0 <?php echo ($visitaacasa == 0 ? "selected" : "") ?> >NO</option>
                                             </select>
                                             <!--<input type = "text" id="visitaacasa" name="visitaacasa" class="form-control input-sm" value="<?php echo $visitaacasa ?>">-->
                                        </div>
                                        <div class="col-xs-5">
                                             <label for = "s_otrodesc">DESCRIBA EL SEGUIMIENTO:</label>
                                             <!--                                    <input type = "text" name="desc" class="form-control input-sm" value="">-->
                                             <textarea name="desc" id="desc" class="form-control input-sm" rows="2" required placeholder="DESCRIBA UN NUEVO SEGUIMIENTO..."><?php echo $desc ?></textarea>
                                        </div>

                                   </div>
                                   <div class="text-right">
                                        <button type="submit" class="btn btn-success" name="seguimiento"><span class='glyphicon glyphicon-ok'> </span>GRABAR SEGUIMIENTO</button>
                                   </div>

                              </form>
                              <hr />






                              <table class="table table-condensed table-hover">
                                   <thead>
                                        <tr>
                                             <th>ID</th>
                                             <th>FECHA</th>
                                             <th>SEGUIMIENTO DADO</th>
                                             <th></th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php
                                        $query = "select * from c03seguimiento s where s.id='$_GET[id]' order by s.fecha desc";
                                        $result = mysqli_query($link, $query);
                                        mysqli_data_seek($result, 0);
                                        while ($row = mysqli_fetch_row($result)) {
                                             ?>
                                             <tr>
                                                  <td><?php echo $row[0] ?></td>
                                                  <td><?php echo date('Y-m-d', strtotime($row[3])) ?></td>
                                                  <td><?php echo $row[4] ?></td>
                                                  <td>
                                                       <a data-toggle="tooltip" data-placement="top" title="Editar" href='#'
                                                       onclick="
                                                       $('#idseg').val(<?php echo $row[0] ?>);
                                                       $('#fecha').val('<?php echo date('Y-m-d', strtotime($row[3])) ?>');
                                                       $('#fdc').val('<?php echo $row[6] ?>');
                                                       $('#desc').val('<?php echo $row[4] ?>');
                                                       $('#visitaacasa').val('<?php echo $row[7] ?>');

                                                       "><span class='glyphicon glyphicon-pencil text-primary'></span></a>

                                                       <a href='#'><span class='glyphicon glyphicon-remove text-danger' ></span></a>

                                                  </td>
                                             </tr>
                                             <?php } ?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>

                    <div class="col-xs-4">
                         <div class="panel panel-warning">
                              <div class="panel-heading"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>DATOS DEL CASO</div>
                              <div class="panel-body">
                                   <table class="table table-condensed table-hover">
                                        <tbody>
                                             <tr>
                                                  <td>CASO #:</td><td><?php echo $id ?></td>
                                             </tr>
                                             <tr>
                                                  <td>NUMERO SC:</td><td><?php echo $sc ?></td>
                                             </tr>
                                             <tr>
                                                  <td>NOMBRE:</td><td><?php echo $rowsc['SC Name'] ?></td>
                                             </tr>
                                             <tr>
                                                  <td>UP:</td><td><?php echo $rowsc['PU Code'] . '-' . $rowsc['PU Name'] ?></td>
                                             </tr>
                                             <tr>
                                                  <td>COMUNIDAD:</td><td><?php echo $rowsc['Afiliation Level Name'] ?></td>
                                             </tr>
                                             <tr>
                                                  <td>FACILITADOR:</td><td><?php echo $rowsc['CW'] ?></td>
                                             </tr>

                                             <tr>
                                                  <td>
                                                  </td>
                                                  <td>
                                                       <form role="form" action="c03casoss" method="post" class="form-horizontal text-danger" id="frmpago">
                                                            <div class="form-group">

                                                                 <div class="col-xs-12">
                                                                      <label for = "visitaacasa">ESTATUS DEL CASO:</label>
                                                                      <select class="form-control input-sm" id="idestatus" name="idestatus" required="required">
                                                                           <?php
                                                                           $query = "select id, estatus, sel from c03estatus where id <> 8 order by 1 ";
                                                                           $result = mysqli_query($link, $query);
                                                                           mysqli_data_seek($result, 0);
                                                                           while ($rowd = mysqli_fetch_row($result)) {
                                                                                echo "<option value='$rowd[0]' "
                                                                                . ($idestatus == $rowd[0] ? "selected" : $rowd[2])
                                                                                . "> $rowd[1]</option>";
                                                                           }
                                                                           ?>
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                            <div class="form-group" id="cerrarcaso">
                                                                 <div class="col-xs-12">
                                                                      <label for = "estatusfecha">AÑO-MES-DÍA:</label>
                                                                      <input type = "date" id="estatusfecha" name="estatusfecha" class="form-control input-sm" value="<?php echo date('Y-m-d') ?>">
                                                                      <br />
                                                                      <div class="text-right">
                                                                           <p class="text-info">No olvide escribir los detalles del seguimiento en la parte izquierda.</p>
                                                                           <button data-toggle="tooltip" data-placement="top" title="No olvide escribir los detalles del seguimiento en la parte izquierda" type="submit" class="btn btn-sm btn-success" name="cerrarcaso"><span class='glyphicon glyphicon-ok'> </span></button>
                                                                           <a href="casos" class="btn btn-sm btn-danger"><span class='glyphicon glyphicon-remove'> </span></a>
                                                                      </div>
                                                                 </div>



                                                            </div>

                                                       </form>
                                                  </td>
                                             </tr>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>



               </div>

          </div>

     </div>








     <?php include 'footer.php'; ?>
