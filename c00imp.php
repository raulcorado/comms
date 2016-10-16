
<?php
include 'secure.php';
include 'app/connection.php';
include 'fnc/functions.php';




include 'header.php';
_PERMITG("comm08a,comm08p");
?>
<h1>Módulo de importación</h1>
<h4>Módulo de importación</h4>

<div class="row">
     <div class="col-md-3">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <p class="panel-title"><span class="glyphicon glyphicon-import" aria-hidden="true"></span><strong>TO-DO</strong> : semanal</p>
               </div>
               <div class="panel-body">
                    <form action="c00imp" method="post" name="importar" id="form1" enctype="multipart/form-data">
                         <div class="form-group">
                              To-Do List
                              <label class="btn btn-primary text-right" for="file">
                                   <input name="file" id="file" type="file">
                              </label>
                              <small id="a" class="text-info"></small>
                              <div class="progress">
                                   <div id="mybar" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class=" text-right">
                                   <button type="submit" class="btn btn-sm btn-primary" name="submittodo"><span class='glyphicon glyphicon-import'> </span> Importar</button>
                              </div>
                         </div>
                    </form>

               </div>
          </div>
     </div>

     <div class="col-md-3">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <p class="panel-title"><span class="glyphicon glyphicon-import" aria-hidden="true"></span><strong>SC ACTIVE</strong> : semestral </p>
               </div>
               <div class="panel-body">
                    <form action="c00imp" method="post" name="importar" id="form2" enctype="multipart/form-data">
                         <div class="form-group">
                              SC Act/Can Query Tool
                              <label class="btn btn-info" for="filesc">
                                   <input name="filesc" type="file" >
                              </label>
                              <small id="asc" class="text-info"></small>
                              <div class="progress">
                                   <div id="mybarsc" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class=" text-right">
                                   <button type="submit" class="btn btn-sm btn-info" name="submitsc"><span class='glyphicon glyphicon-import'> </span> Importar</button>
                              </div>
                         </div>
                    </form>

               </div>
          </div>
     </div>

     <div class="col-md-3">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <p class="panel-title"><span class="glyphicon glyphicon-import" aria-hidden="true"></span><strong>LOCATION</strong> : anual </p>
               </div>
               <div class="panel-body">
                    <form action="c00imp" method="post" name="importar" id="form3" enctype="multipart/form-data">
                         <div class="form-group">
                              Location TAG
                              <label class="btn btn-warning" for="filesc">
                                   <input name="filetag" type="file" >
                              </label>
                              <small id="atag" class="text-info"></small>
                              <div class="progress">
                                   <div id="mybartag" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <hr>
                              Location TYPE
                              <label class="btn btn-warning" for="filesc">
                                   <input name="filetyp" type="file" >
                              </label>
                              <small id="atyp" class="text-info"></small>
                              <div class="progress">
                                   <div id="mybartyp" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="text-right">
                                   <button type="submit" class="btn btn-sm btn-warning" name="submitloca"><span class='glyphicon glyphicon-import'> </span> Importar</button>
                              </div>
                         </div>
                    </form>

               </div>
          </div>
     </div>


     <div class="col-md-3">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <p class="panel-title"><span class="glyphicon glyphicon-import" aria-hidden="true"></span><strong>R PROD</strong> : mensual </p>
               </div>
               <div class="panel-body">
                    <form action="c00imp" method="post" name="importar" id="form4" enctype="multipart/form-data">
                         <div class="form-group">
                              REPORTE DE PRODUCCIÓN
                              <label class="btn btn-warning" for="fileprod">
                                   <input name="fileprod" type="file" >
                              </label>

                              CORRESPONDITENTE A:
                              <div class="input-group">
                                   <select class="form-control input-sm col-md-5" name="pu" required="required">
                                        <option value='' selected>UP</option>";
                                        <?php
                                        $query = "SELECT * FROM generallocationup";
                                        $result = mysqli_query($link, $query);
                                        mysqli_data_seek($result, 0);
                                        while ($rowd = mysqli_fetch_row($result)) {
                                             echo "<option value='" . $rowd[0] . "' >" . $rowd[1] . "</option>";
                                        }
                                        ?>
                                   </select>
                                   <select class="form-control input-sm col-md-4" name="ano" required="required">
                                        <option value='' selected>AÑO</option>";
                                        <option value='<?php echo date("Y")-1 ?>' ><?php echo date("Y")-1 ?></option>";
                                        <option value='<?php echo date("Y") ?>' ><?php echo date("Y") ?></option>";
                                        <option value='<?php echo date("Y")+1 ?>' ><?php echo date("Y")+1 ?></option>";

                                   </select>
                                   <select class="form-control input-sm col-md-3" name="mes" required="required">
                                        <option value='' selected>MES</option>";
                                        <?php
                                        for ($i=1; $i <=12 ; $i++) {
                                             ?>
                                             <option value='<?php echo $i ?>' ><?php echo $i ?></option>";
                                             <?php
                                        }
                                        ?>
                                   </select>
                              </div>

                              <small id="prod" class="text-info"></small>
                              <div class="progress">
                                   <div id="mybarprod" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class=" text-right">
                                   <button type="submit" class="btn btn-sm btn-warning" name="submitrepprod"><span class='glyphicon glyphicon-import'> </span>Importar</button>
                              </div>
                         </div>
                    </form>

               </div>
          </div>
     </div>


</div>
<?php


if (isset($_POST['submittodo'])) {

     $file = $_FILES['file']['tmp_name'];

     $fl = file($file);
     $count = count($fl);

     if ($_FILES['file']['size'] > 0) {
          $handle = fopen($file, "r");
          $e = 0;
          $i = 0;
          $s = 0;
          set_time_limit(0);
          while (($data = fgetcsv($handle, 10000, ',', '"')) !== false) {

               $comtypearray=array("WGC","ECO","SPC","SGC");
               if (in_array($data[9],$comtypearray)) {
                    $spname = preg_replace('/[^À-ÿA-z0-9áéíóúñÑ\s.%\/]/', '-', $data[8]);
                    $query="replace into `c08todolist` (`pu`,     `location`, `cw`,       `sc`,       `scname`,   `scage`,    `no`,       `sp`,      `spname`,   `comtype`, `duebefore`,                            `monthsoverdue`, `comments`, `ackcomments`) VALUES "
                    ."($data[0], '$data[1]', '$data[2]', $data[3],  '$data[4]',  $data[5],  '$data[6]', '$data[7]', '$spname', '$data[9]', STR_TO_DATE('$data[10]', '%d/%m/%Y'), '$data[11]',     '$data[12]','$data[13]')";
                    $result = mysqli_query($link, $query);

                    if (!$result) {
                         $e++;
                         echo $query;
                         echo '<br />';
                    } else {
                         $s++;
                         //echo "$data[1]\n";
                         //echo ".";
                    }
               }
               $i++;
               $p = round($i * 100 / $count, 0);
               ob_flush();
               echo "<script language='javascript'> "
               . "$('#mybar').show();"
               . "$('#mybar').css('width', '$p%');"
               . "$('#mybar').text('$p%');"
               . "$('#a').text('$data[9] $data[4]');"
               . "</script>";
               flush();


          }
          echo "<script language='javascript'> "
          . "$('#mybar').css('width', '100%');"
          . "$('#mybar').text('100%');"
          . "$('#a').text('Procesados:$s.  Con error:$e');"
          . "</script>";

     }
}

if (isset($_POST['submitsc'])) {


     $file = $_FILES['filesc']['tmp_name'];
     $fl = file($file);
     $count = count($fl);
     if ($_FILES['filesc']['size'] > 0) {
          // ini_set('display_errors',1);
          $handle = fopen($file, "r");
          $e = 0;
          $i = 0;
          $s = 0;
          set_time_limit(60);



          while (($data = fgetcsv($handle, 10000, ',', '"')) !== false) {

               $comtypearray=array("F","M");
               if (in_array($data[6],$comtypearray)) {
                    for ($j=0; $j <=8 ; $j++) {
                         $data[$j] = preg_replace('/[^À-ÿA-z0-9áéíóúñÑ\s.%\/]/', '-', $data[$j]);
                    }
                    if (strlen($data[0])>3) {
                         $scstatus = strtoupper($data[0]);
                    } else {
                         $scstatus = 'CANCELADO';
                    }
                    ob_flush();
                    flush();




                    $query="replace into `scactive` (`SC Status`, `SC Number`, `SC Name`,  `NO Code`,  `SP Number`, `SP Name`,  `Gender`,   `DOB`,                               `Afiliation Level Name`, `CW`,        `PU Code`,   `PU Name`) VALUES "
                    ."                              ('$scstatus',  $data[1],   '$data[2]', '$data[3]', '$data[4]',  '$data[5]', '$data[6]', STR_TO_DATE('$data[7]', '%d/%m/%Y'), '$data[8]',              '$data[9]',  '$data[10]', '$data[11]')";
                    $result = mysqli_query($link, $query);

                    if (!$result) {
                         $e++;
                         echo $query;
                         echo '<br />';
                    } else {
                         $s++;
                         //echo "$data[1]\n";
                         //echo ".";
                    }
               }
               $i++;
               $p = round($i * 100 / $count, 0);

               echo "<script language='javascript'> "
               . "$('#mybarsc').show();"
               . "$('#mybarsc').css('width', '$p%');"
               . "$('#mybarsc').text('$p%');"
               . "$('#asc').text('$data[8] $data[2]');"
               . "</script>";


          }
          echo "<script language='javascript'> "
          . "$('#mybarsc').css('width', '100%');"
          . "$('#mybarsc').text('100%');"
          . "$('#asc').text('Procesados con exito:$s.    Con error:$e');"
          . "</script>";
          //COMPROMISO 10 recargará los SC que cumplen años a la tabla c10control
          $query="insert ignore into c10control (scnumber, nocode, spnumber, spname, dob, age) select sscnumber, snocode, sspnumber, sspname, sdob, edad from general10scactive ";
          $result = mysqli_query($link, $query);
     }
}



if (isset($_POST['submitloca'])) {
     $file = $_FILES['filetag']['tmp_name'];
     $fl = file($file);
     $count = count($fl);
     if ($_FILES['filetag']['size'] > 0) {
          $handle = fopen($file, "r");
          $e = 0;
          $i = 0;
          $s = 0;
          while (($data = fgetcsv($handle, 1000, ',', '"')) !== false) {
               ob_flush();
               flush();
               $query="replace into `ch_locationtag` (`csitecode`, `ositecode`, `locationtagid`, `ownerlocationcode`, `locationtypeid`, `name`,     `code`,     `month`,    `nominalscs`, `parenttagid`, `urbanflag`, `siteofscenrr`, `contactdetails`, `notes`,    `estatus`,    `beenscenrrolmentsite`)"
               . "        VALUES                     ('$data[0]',  '$data[1]',  '$data[2]',      '$data[3]',          '$data[4]',       '$data[5]', '$data[6]', '$data[7]', '$data[8]',   '$data[9]',    '$data[10]', '$data[11]',    '$data[12]',      '$data[13]', '$data[14]', '$data[15]')";
               $result = mysqli_query($link, $query);

               if (!$result) {
                    $e++;
                    echo $query;
                    echo '<br />';
               } else {
                    $s++;
                    //echo "$data[1]\n";
                    //echo ".";
               }
               $i++;
               $p = round($i * 100 / $count, 0);

               echo "<script language='javascript'> "
               . "$('#mybartag').show();"
               . "$('#mybartag').css('width', '$p%');"
               . "$('#mybartag').text('$p%');"
               . "$('#atag').text('$data[8] $data[2]');"
               . "</script>";


          }
          echo "<script language='javascript'> "
          . "$('#mybartag').css('width', '100%');"
          . "$('#mybartag').text('100%');"
          . "$('#atag').text('Procesados con exito:$s.    Con error:$e');"
          . "</script>";

     }
     $file = $_FILES['filetyp']['tmp_name'];
     $fl = file($file);
     $count = count($fl);
     if ($_FILES['filetyp']['size'] > 0) {
          $handle = fopen($file, "r");
          $e = 0;
          $i = 0;
          $s = 0;
          while (($data = fgetcsv($handle, 1000, ',', '"')) !== false) {
               ob_flush();
               flush();


               $query="replace into `ch_locationtype` (`locationtypeid`, `planlevel`, `locallevel`, `ownerlocationcode`, `name`, `description`) "
               ."                              VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]')";
               $result = mysqli_query($link, $query);

               if (!$result) {
                    $e++;
                    echo $query;
                    echo '<br />';
               } else {
                    $s++;
                    //echo "$data[1]\n";
                    //echo ".";
               }
               $i++;
               $p = round($i * 100 / $count, 0);

               echo "<script language='javascript'> "
               . "$('#mybartyp').show();"
               . "$('#mybartyp').css('width', '$p%');"
               . "$('#mybartyp').text('$p%');"
               . "$('#atyp').text('$data[3] $data[2]');"
               . "</script>";


          }
          echo "<script language='javascript'> "
          . "$('#mybartyp').css('width', '100%');"
          . "$('#mybartyp').text('100%');"
          . "$('#atyp').text('Procesados con exito:$s.    Con error:$e');"
          . "</script>";
     }
}


if (isset($_POST['submitrepprod'])) {
     ini_set('display_errors',1);
     $file = $_FILES['fileprod']['tmp_name'];
     $fl = file($file);
     $count = count($fl);
     if ($_FILES['fileprod']['size'] > 0) {
          $handle = fopen($file, "r");
          $e = 0;
          $i = 0;
          $s = 0;
          $types = array("SCU", "SCI", "SGC","SPC","WGC","FWL","ECO");
          while (($data = fgetcsv($handle, 1000, ',', '"')) !== false) {
               ob_flush();
               flush();

               if (in_array($data[0], $types)) {
                    $query="replace into `c67910production` (`type`,     `currentdue`, `previousdue`, `totalforresponse`, `respondedto`, `respondedtop`, `mes`,                                                            `pucode`,    `userid`,            `fechareg`) "
                    . "                              VALUES ('$data[0]', '$data[1]',   '$data[2]',    '$data[3]',         '$data[4]',    '$data[5]',     STR_TO_DATE('" . $_POST['ano'] . "/" . $_POST['mes'] . "/01', '%Y/%m/%d'), '$_POST[pu]', '$_SESSION[userid]', CURRENT_TIMESTAMP) ";
                    echo "$query";
                    $result = mysqli_query($link, $query);

                    if (!$result) {
                         $e++;
                         echo $query;
                         echo '<br />';
                    } else {
                         $s++;
                         //echo "$data[1]\n";
                         //echo ".";
                    }
                    $i++;
                    $p = round($i * 100 / $count, 0);

                    echo "<script language='javascript'> "
                    . "$('#mybarprod').show();"
                    . "$('#mybarprod').css('width', '$p%');"
                    . "$('#mybarprod').text('$p%');"
                    . "$('#atag').text('$data[8] $data[2]');"
                    . "</script>";
               }
          }
          echo "<script language='javascript'> "
          . "$('#mybarprod').css('width', '100%');"
          . "$('#mybarprod').text('100%');"
          . "$('#prod').text('Procesados con exito:$s.    Con error:$e');"
          . "</script>";
     }
}





include 'footer.php';
?>
