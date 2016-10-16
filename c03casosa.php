<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';

$msg = "";



if (isset($_POST['aceptar'])) {
     _PERMITG("comm03a,comm03p,comm03u");
     $userid = $_SESSION['userid'];

     $sc = $_POST['sc'];
     $id = $_POST['id'];
     $idestatus = $_POST['idestatus'];
     $boletafecha = $_POST['boletafecha'];

     $n_nutricestado = $_POST['n_nutricestado'];
     // $n_hallazgo = ((($n_nutricestado > 0) && ($n_nutricestado <= 12.5)) ? 1 : 0);
     $n_hallazgo = (($n_nutricestado > 0) ? 1 : 0);

     $s_calentmasde3dias = ((isset($_POST['s_calentmasde3dias'])) ? 1 : 0);
     $s_tos = ((isset($_POST['s_tos'])) ? 1 : 0);
     $s_lecuestarespirar = ((isset($_POST['s_lecuestarespirar'])) ? 1 : 0);
     $s_vomito = ((isset($_POST['s_vomito'])) ? 1 : 0);
     $s_ojosundidos = ((isset($_POST['s_ojosundidos'])) ? 1 : 0);
     $s_abundantediarrea = ((isset($_POST['s_abundantediarrea'])) ? 1 : 0);
     $s_ningunsintoma = ((isset($_POST['s_ningunsintoma'])) ? 1 : 0);
     $s_enfermedadpiel = ((isset($_POST['s_enfermedadpiel'])) ? 1 : 0);
     $s_caidamollera = ((isset($_POST['s_caidamollera'])) ? 1 : 0);
     $s_otro = (trim($_POST['s_otrodesc']) != "" ? 1 : 0);
     $s_otrodesc = trim($_POST['s_otrodesc']);
     $s_hallazgo = (($s_calentmasde3dias + $s_tos + $s_lecuestarespirar + $s_vomito + $s_ojosundidos + $s_abundantediarrea + $s_ningunsintoma + $s_enfermedadpiel + $s_caidamollera + $s_otro) > 0 ? 1 : 0);

     $p_heridas = ((isset($_POST['p_heridas'])) ? 1 : 0);
     $p_cicatrices = ((isset($_POST['p_cicatrices'])) ? 1 : 0);
     $p_noseobssintomasanormales = ((isset($_POST['p_noseobssintomasanormales'])) ? 1 : 0);
     $p_siempresinacompadulto = ((isset($_POST['p_siempresinacompadulto'])) ? 1 : 0);
     $p_evidenciapeligrotrabajo = ((trim($_POST['p_evidenciapeligrotrabajodesc']) != "") ? 1 : 0);
     $p_evidenciapeligrotrabajodesc = $_POST['p_evidenciapeligrotrabajodesc'];
     $p_otro = ((trim($_POST['p_otrodesc']) != "") ? 1 : 0);
     $p_otrodesc = $_POST['p_otrodesc'];
     $p_hallazgo = (($p_heridas + $p_cicatrices + $p_noseobssintomasanormales + $p_siempresinacompadulto + $p_evidenciapeligrotrabajo + $p_otro) > 0 ? 1 : 0);


     $e_noestaescuela = (((isset($_POST['e_noestaescuela'])) or ( trim($_POST['e_razonpolaquenova']) != "")) ? 1 : 0);
     $e_grado = $_POST['e_grado'];
     $e_razonpolaquenova = $_POST['e_razonpolaquenova'];

     $e_hallazgo = (($e_noestaescuela) > 0 ? 1 : 0);

     $g_hamuertoninojovenultima = ((isset($_POST['g_hamuertoninojovenultima'])) ? 1 : 0);
     $g_hamuertoninojovenultimacuando = $_POST['g_hamuertoninojovenultimacuando'];
     $g_hamuertoninojovenultimaparentezco = $_POST['g_hamuertoninojovenultimaparentezco'];
     $g_hamuertoninojovenultimarazon = $_POST['g_hamuertoninojovenultimarazon'];

     $observaciones = $_POST['observaciones'];

     if (($n_hallazgo + $s_hallazgo + $p_hallazgo + $e_hallazgo) == 0) {
          $msg = "NO se almacenó el registro. Ningún hallazgo detectado";
     }
     else {
          if ($_SESSION['nuevo'] == TRUE) {
               $query = "insert into `c03boletas` (`sc`, `boletafecha`,   `estatusfecha`, `userid`, `n_hallazgo`, `n_nutricestado`, `s_hallazgo`, `s_calentmasde3dias`, `s_tos`, `s_lecuestarespirar`,         `s_vomito`, `s_ojosundidos`, `s_abundantediarrea`, `s_ningunsintoma`, `s_enfermedadpiel`, `s_caidamollera`, `s_otro`,        `s_otrodesc`, `p_hallazgo`, `p_heridas`, `p_cicatrices`, `p_noseobssintomasanormales`, `p_siempresinacompadulto`, `p_evidenciapeligrotrabajo`, `p_evidenciapeligrotrabajodesc`,         `p_otro`, `p_otrodesc`, `e_hallazgo`, `e_noestaescuela`, `e_grado`, `e_razonpolaquenova`, `g_hamuertoninojovenultima`, `g_hamuertoninojovenultimacuando`, `g_hamuertoninojovenultimaparentezco`, `g_hamuertoninojovenultimarazon`, `observaciones`) "
               . "VALUES               ('$sc', '$boletafecha', '$boletafecha', '$userid' , '$n_hallazgo', '$n_nutricestado', '$s_hallazgo', '$s_calentmasde3dias', '$s_tos', '$s_lecuestarespirar', '$s_vomito', '$s_ojosundidos', '$s_abundantediarrea', '$s_ningunsintoma', '$s_enfermedadpiel', '$s_caidamollera', '$s_otro', '$s_otrodesc', '$p_hallazgo', '$p_heridas', '$p_cicatrices', '$p_noseobssintomasanormales', '$p_siempresinacompadulto', '$p_evidenciapeligrotrabajo', '$p_evidenciapeligrotrabajodesc', '$p_otro', '$p_otrodesc', '$e_hallazgo', '$e_noestaescuela', '$e_grado', '$e_razonpolaquenova', '$g_hamuertoninojovenultima', '$g_hamuertoninojovenultimacuando', '$g_hamuertoninojovenultimaparentezco', '$g_hamuertoninojovenultimarazon', '$observaciones')";
          }
          else {
               //$query = "update `boletas` SET `sc`='$sc', `boletafecha`='$boletafecha', `userid`='$userid' , `n_hallazgo`='$n_hallazgo', `n_nutricestado`='$n_nutricestado', `s_hallazgo`='$s_hallazgo', `s_calentmasde3dias`='$s_calentmasde3dias', `s_tos`='$s_tos', `s_lecuestarespirar`='$s_lecuestarespirar', `s_vomito`='$s_vomito', `s_ojosundidos`='$s_ojosundidos', `s_abundantediarrea`='$s_abundantediarrea', `s_ningunsintoma`='$s_ningunsintoma', `s_enfermedadpiel`='$s_enfermedadpiel', `s_caidamollera`='$s_caidamollera', `s_otro`='$s_otro', `s_otrodesc`='$s_otrodesc', `p_hallazgo`='$p_hallazgo', `p_heridas`='$p_heridas', `p_cicatrices`='$p_cicatrices', `p_noseobssintomasanormales`='$p_noseobssintomasanormales', `p_siempresinacompadulto`='$p_siempresinacompadulto', `p_evidenciapeligrotrabajo`='$p_evidenciapeligrotrabajo', `p_evidenciapeligrotrabajodesc`='$p_evidenciapeligrotrabajodesc', `p_otro`='$p_otro', `p_otrodesc`='$p_otrodesc', `e_hallazgo`='$e_hallazgo', `e_noestaescuela`='$e_noestaescuela', `e_grado`='$e_grado', `e_razonpolaquenova`='$e_razonpolaquenova', `g_hamuertoninojovenultima`='$g_hamuertoninojovenultima', `g_hamuertoninojovenultimacuando`='$g_hamuertoninojovenultimacuando', `g_hamuertoninojovenultimaparentezco`='$g_hamuertoninojovenultimaparentezco', `g_hamuertoninojovenultimarazon`='$g_hamuertoninojovenultimarazon' WHERE `id` = '$id'";
               $query = "update `c03boletas` SET `sc`='$sc', `userid`='$userid', `boletafecha`='$boletafecha', `n_hallazgo`='$n_hallazgo', `n_nutricestado`='$n_nutricestado', `s_hallazgo`='$s_hallazgo', `s_calentmasde3dias`='$s_calentmasde3dias', `s_tos`='$s_tos', `s_lecuestarespirar`='$s_lecuestarespirar', `s_vomito`='$s_vomito', `s_ojosundidos`='$s_ojosundidos', `s_abundantediarrea`='$s_abundantediarrea', `s_ningunsintoma`='$s_ningunsintoma', `s_enfermedadpiel`='$s_enfermedadpiel', `s_caidamollera`='$s_caidamollera', `s_otro`='$s_otro', `s_otrodesc`='$s_otrodesc', `p_hallazgo`='$p_hallazgo', `p_heridas`='$p_heridas', `p_cicatrices`='$p_cicatrices', `p_noseobssintomasanormales`='$p_noseobssintomasanormales', `p_siempresinacompadulto`='$p_siempresinacompadulto', "
               . "`p_evidenciapeligrotrabajo`='$p_evidenciapeligrotrabajo', `p_evidenciapeligrotrabajodesc`='$p_evidenciapeligrotrabajodesc', `p_otro`='$p_otro', `p_otrodesc`='$p_otrodesc', `e_hallazgo`='$e_hallazgo', `e_noestaescuela`='$e_noestaescuela', `e_grado`='$e_grado', `e_razonpolaquenova`='$e_razonpolaquenova', `g_hamuertoninojovenultima`='$g_hamuertoninojovenultima', `g_hamuertoninojovenultimacuando`='$g_hamuertoninojovenultimacuando', `g_hamuertoninojovenultimaparentezco`='$g_hamuertoninojovenultimaparentezco', `g_hamuertoninojovenultimarazon`='$g_hamuertoninojovenultimarazon', `observaciones`='$observaciones' WHERE `id` = '$id'";
          }

          $result = mysqli_query($link, $query);
          if (!$result) {
               $msg = "Ocurrio un problema al agregar los datos \n $query";
          } else {
               $msg = "El registro se almacenó correctamente";
          }
     }

     header("Location:c03?msg=$msg");
}

if (isset($_GET['nuevo_caso'])) {
     $_SESSION['nuevo'] = TRUE;
     $sc = $_GET['nuevo_caso'];
     $query = "select * from `scactive` where `sc number`='$sc'";
     $result = mysqli_query($link, $query);
     $boletafecha = date('Y-m-d');
     $n_nutricestado = 0;
     if (mysqli_num_rows($result) == 1) {
          $rowsc = mysqli_fetch_array($result);
     } else {
          header("Location:c03?msg=No fué posible continuar. Seleccione un SC válido.");
     }
}

if (isset($_GET[id])) {
     $_SESSION['nuevo'] = FALSE;

     $query = "select * from c03boletas where id='$_GET[id]'";
     $result = mysqli_query($link, $query);
     $rowid = mysqli_fetch_array($result);


     $id = $rowid['id'];
     $sc = $rowid['sc'];
     $userid = $rowid['userid'];

     $idestatus = $rowid['idestatus'];

     $boletafecha = date('Y-m-d', strtotime($rowid['boletafecha']));

     $n_nutricestado = $rowid['n_nutricestado'];

     $s_calentmasde3dias = ($rowid['s_calentmasde3dias'] == 1 ? "checked" : "");
     $s_tos = ($rowid['s_tos'] == 1 ? "checked" : "");
     $s_lecuestarespirar = ($rowid['s_lecuestarespirar'] == 1 ? "checked" : "");
     $s_vomito = ($rowid['s_vomito'] == 1 ? "checked" : "");
     $s_ojosundidos = ($rowid['s_ojosundidos'] == 1 ? "checked" : "");
     $s_abundantediarrea = ($rowid['s_abundantediarrea'] == 1 ? "checked" : "");
     $s_ningunsintoma = ($rowid['s_ningunsintoma'] == 1 ? "checked" : "");
     $s_enfermedadpiel = ($rowid['s_enfermedadpiel'] == 1 ? "checked" : "");
     $s_caidamollera = ($rowid['s_caidamollera'] == 1 ? "checked" : "");
     $s_otro = ($rowid['s_otro'] == 1 ? "checked" : "");
     $s_otrodesc = $rowid['s_otrodesc'];


     $p_heridas = ($rowid['p_heridas'] == 1 ? "checked" : "");
     $p_cicatrices = ($rowid['p_cicatrices'] == 1 ? "checked" : "");
     $p_noseobssintomasanormales = ($rowid['p_noseobssintomasanormales'] == 1 ? "checked" : "");
     $p_siempresinacompadulto = ($rowid['p_siempresinacompadulto'] == 1 ? "checked" : "");
     $p_evidenciapeligrotrabajo = ($rowid['p_evidenciapeligrotrabajo'] == 1 ? "checked" : "");
     $p_evidenciapeligrotrabajodesc = $rowid['p_evidenciapeligrotrabajodesc'];
     $p_otro = ($rowid['p_otro'] == 1 ? "checked" : "");
     $p_otrodesc = $rowid['p_otrodesc'];


     $e_noestaescuela = ($rowid['e_noestaescuela'] == 1 ? "checked" : "");
     $e_grado = $rowid['e_grado'];
     $e_razonpolaquenova = $rowid['e_razonpolaquenova'];


     $g_hamuertoninojovenultima = ($rowid['g_hamuertoninojovenultima'] == 1 ? "checked" : "");
     $g_hamuertoninojovenultimacuando = $rowid['g_hamuertoninojovenultimacuando'];
     $g_hamuertoninojovenultimaparentezco = $rowid['g_hamuertoninojovenultimaparentezco'];
     $g_hamuertoninojovenultimarazon = $rowid['g_hamuertoninojovenultimarazon'];

     $observaciones = $rowid['observaciones'];

     $query = "select * from `scactive` where `sc number`='$sc'";
     $result = mysqli_query($link, $query);
     $rowsc = mysqli_fetch_array($result);
}



include 'header.php';
_PERMITG("comm03a,comm03p,comm03u,comm03v");
?>




<div class="container-fluid">
     <div class="row">
          <div class="col-xs-12">
               <h1>Casos</h1>
               <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-paperclip" aria-hidden="true">  </span></div>
                    <div class="panel-body">
                         <form role="form" action="c03casosa" method="post" class="form-horizontal" id="frmpago">

                              <div class="form-group">
                                   <div class="col-xs-2">
                                        <label for="id">ID:</label>
                                        <input type="text" id="id" name="id" class="form-control input-sm" required="required" value="<?php echo $id ?>" readonly>
                                   </div>
                                   <div class="col-xs-3">
                                        <label for="sc">NUMERO SC:</label>
                                        <input type="text" id="sc" name="sc" class="form-control input-sm" required="required" value="<?php echo $sc ?>" readonly>
                                   </div>
                                   <div class="col-xs-3">
                                        <label for="boletafecha">FECHA:</label>
                                        <input type="date" id="boletafecha" name="boletafecha" class="form-control input-sm" required="required" value="<?php echo $boletafecha ?>">
                                   </div>
                                   <!--                            <div class="col-xs-3">
                                   <label for="idestatus">ESTATUS:</label>
                                   <select class="form-control input-sm" id="idestatus" name="idestatus" required="required" readonly>
                                   <?php
                                   //                                    $query = "select id, estatus, sel from estatus order by 1";
                                   //                                    $result = mysqli_query($link, $query);
                                   //                                    mysqli_data_seek($result, 0);
                                   //                                    while ($rowd = mysqli_fetch_row($result)) {
                                   //                                        echo "<option value='$rowd[0]' "
                                   //                                        . ($idestatus == $rowd[0] ? "selected" : $rowd[2])
                                   //                                        . "> $rowd[1]</option>";
                                   //                                    }
                                   ?>
                              </select>
                         </div>-->
                    </div>
                    <div class="form-group">
                         <div class="col-xs-12">
                              <p class="text-info">
                                   <strong>
                                        <?php echo $rowsc['SC Number'] . ", " . strtoupper($rowsc['SC Name'] . ", " . $rowsc['Age'] . $rowsc['PU Code'] . "-" . $rowsc['PU Name'] . ", " . $rowsc['Afiliation Level Name'] . ", " . $rowsc['CW']) ?>
                                   </strong>
                              </p>
                         </div>
                    </div>




                    <div class="panel panel-danger">
                         <div class="panel-heading"   >
                              <ul class="nav nav-tabs">
                                   <li class="active"><a aria-expanded="true" href="#2" data-toggle="tab" class="btn btn-default">1. NUTRICION</a></li>
                                   <li class=""><a aria-expanded="false" href="#3" data-toggle="tab" class="btn btn-default">2. SALUD</a></li>
                                   <li class=""><a aria-expanded="false" href="#4" data-toggle="tab" class="btn btn-default">3. PROTECCION</a></li>
                                   <li class=""><a aria-expanded="false" href="#5" data-toggle="tab" class="btn btn-default">4. EDUCACION</a></li>
                                   <li class=""><a aria-expanded="false" href="#6" data-toggle="tab" class="btn btn-default">OTROS</a></li>
                              </ul>

                         </div>
                         <div class="panel-body"   >

                              <div id="myTabContent" class="tab-content">
                                   <div class="tab-pane fade active in" id="2">
                                        <h4 >1. NUTRICION:</h4>
                                        <div class="form-group">
                                             <div class="col-xs-12">
                                                  <div class="row">
                                                       <div class="col-xs-3">
                                                            <label for = "n_nutricestado">MEDIDA:</label>
                                                            <input type="number" id="n_nutricestado" name="n_nutricestado" class="form-control input-sm" required="required" min="0" max="26.5" step="0.5" value="<?php echo $n_nutricestado ?>">
                                                       </div>
                                                  </div>
                                                  <div class="row">
                                                       <div class="col-xs-12">
                                                            <br />
                                                            <p>DPE Aguda Severa < 11.5cm. DPE Aguda Moderada 11.5cm - 12.5cm. Normal > 12.5cm</p>
                                                            <p>La <strong>cinta de Shakir</strong> es un método con el que medimos la circunferencia del brazo de un niño o una niña para determinar si está en estado de desnutrición </p>
                                                       </div>
                                                  </div>
                                             </div>

                                        </div>
                                   </div>
                                   <div class="tab-pane fade" id="3">
                                        <h4 >2. SALUD:</h4>

                                        <div class="form-group">
                                             <div class="col-xs-4">
                                                  <div class="checkbox"><label><input type="checkbox" name="s_calentmasde3dias" <?php echo $s_calentmasde3dias ?>> Calentura mas de 3 días</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="s_tos" <?php echo $s_tos ?>> Tos</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="s_lecuestarespirar" <?php echo $s_lecuestarespirar ?>> Le cuesta respirar</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="s_vomito" <?php echo $s_vomito ?>> Vomitos</label></div>
                                             </div>
                                             <div class="col-xs-4">
                                                  <div class="checkbox"><label><input type="checkbox" name="s_ojosundidos" <?php echo $s_ojosundidos ?>> Ojos hundidos</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="s_abundantediarrea" <?php echo $s_abundantediarrea ?>> Abundante diarrea</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="s_ningunsintoma" <?php echo $s_ningunsintoma ?>> Sin sintomas aparentes</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="s_enfermedadpiel" <?php echo $s_enfermedadpiel ?>> Enfermedad en la piel</label></div>
                                             </div>
                                             <div class="col-xs-4">
                                                  <div class="checkbox"><label><input type="checkbox" name="s_caidamollera" <?php echo $s_caidamollera ?>> Caida mollera</label></div>
                                                  <br />

                                                  <label for = "s_otrodesc">OTRO Descripcion:</label>
                                                  <input type = "text" name="s_otrodesc" class="form-control input-sm" value="<?php echo $s_otrodesc ?>">

                                             </div>

                                        </div>
                                   </div>
                                   <div class="tab-pane fade" id="4">
                                        <h4 >3. PROTECCION:</h4>
                                        <div class="form-group">
                                             <div class="col-xs-4">
                                                  <div class="checkbox"><label><input type="checkbox" name="p_heridas" <?php echo $p_heridas ?>> Heridas</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="p_cicatrices" <?php echo $p_cicatrices ?>> Cicatrices</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="p_noseobssintomasanormales" <?php echo $p_noseobssintomasanormales ?>> Sin sintomas anormales aparentes</label></div>
                                             </div>
                                             <div class="col-xs-4">
                                                  <div class="checkbox"><label><input type="checkbox" name="p_siempresinacompadulto" <?php echo $p_siempresinacompadulto ?>> Sin la compañia de un adulto</label></div>
                                                  <div class="checkbox"><label><input type="checkbox" name="p_evidenciapeligrotrabajo" <?php echo $p_evidenciapeligrotrabajo ?>> Evidencia peligo de trabajo</label></div>


                                             </div>
                                             <div class="col-xs-4">
                                                  <!--                                <div class="checkbox"><label><input type="checkbox" name="p_otro"> Otro</label></div>-->
                                                  <label for = "p_otrodesc">OTRO:</label>
                                                  <input type = "text" name = "p_otrodesc" class = "form-control input-sm"  value="<?php echo $p_otrodesc ?>">
                                                  <label for = "p_evidenciapeligrotrabajodesc">Evidencia Peligro Tarabajo:</label>
                                                  <input type = "text" name = "p_evidenciapeligrotrabajodesc" class = "form-control input-sm" value="<?php echo $p_evidenciapeligrotrabajodesc ?>">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="tab-pane fade" id="5">
                                        <h4 >4. EDUCACION:</h4>
                                        <div class="form-group">
                                             <div class="col-xs-4">
                                                  <div class="checkbox"><label><input type="checkbox" name="e_noestaescuela" <?php echo $e_noestaescuela ?>> NO ASISTE a la escuela</label></div>
                                             </div>
                                             <div class="col-xs-4">
                                                  <label for = "e_grado">GRADO:</label>
                                                  <input type = "text" name = "e_grado" class = "form-control input-sm" value="<?php echo $e_grado ?>">
                                             </div>
                                             <div class="col-xs-4">
                                                  <label for = "e_razonpolaquenova">RAZON POR LA QUE NO VA:</label>
                                                  <input type = "text" name = "e_razonpolaquenova" class = "form-control input-sm" value="<?php echo $e_razonpolaquenova ?>">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="tab-pane fade" id="6">
                                        <h4 > Otra información:</h4>
                                        <div class="form-group">
                                             <div class="col-xs-4">
                                                  <div class="checkbox"><label><input type="checkbox" name="g_hamuertoninojovenultima" <?php echo $g_hamuertoninojovenultima ?>> Ha muerto alguien en su familia en los ultimos meses</label></div>
                                             </div>
                                             <div class="col-xs-4">
                                                  <label for = "g_hamuertoninojovenultimacuando">CUANDO FALLECIO:</label>
                                                  <input type = "text" name = "g_hamuertoninojovenultimacuando" class = "form-control input-sm" value="<?php echo $g_hamuertoninojovenultimacuando ?>">

                                                  <label for = "g_hamuertoninojovenultimaparentezco">PARENTEZCO CON SC:</label>
                                                  <input type = "text" name = "g_hamuertoninojovenultimaparentezco" class = "form-control input-sm" value="<?php echo $g_hamuertoninojovenultimaparentezco ?>">


                                             </div>
                                             <div class="col-xs-4">
                                                  <label for = "g_hamuertoninojovenultimarazon">RAZON DEL FALLECIMIENTO:</label>
                                                  <input type = "text" name = "g_hamuertoninojovenultimarazon" class = "form-control input-sm" value="<?php echo $g_hamuertoninojovenultimarazon ?>">
                                             </div>
                                        </div>
                                   </div>
                              </div>

                         </div>

                    </div>








                    <div class="form-group">
                         <div class="col-xs-10">
                              <label for = "observaciones">OBSERVACIONES GENERALES:</label>
                              <textarea name="observaciones" id="observaciones" class="form-control input-sm" rows="2" placeholder="observaciones"><?php echo $observaciones ?></textarea>
                         </div>

                    </div>

                    <hr />
                    <div class="pull-right">
                         <button type="submit" class="btn btn-success" name="aceptar" data-toggle="tooltip" data-placement="top" title="No presione aquí si no modificó"><span class='glyphicon glyphicon-ok'> </span> GRABAR</button>
                         <a href="c03" class="btn btn-danger"><span class='glyphicon glyphicon-remove'> </span>REGRESAR</a>

                    </div>


               </form>



          </div>
          <div class="panel-footer"></div>
     </div>
</div>
</div>
</div>






<?php include 'footer.php'; ?>
