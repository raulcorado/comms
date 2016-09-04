
<?php
include 'secure.php';
include 'connection.php';


$permit=2;
// 1 admin
// 2 super user <<<<<<
// 3 usuario
// 4 visitante
if ($_SESSION[rolid]>$permit) {
      header("Location:403");
}




//if ($_SESSION['rolid'] <> 3) {
//    echo "<hr/><p>Solo el administrador podrá importar datos desde el CD <br /> </p>";
//}

include 'header.php';
?>




<?php
// PROCEDIMIENTO IMPORTAR
?>
<h1>Importar</h1>
<h4>Importar</h4>

<div class="row">
      <div class="col-md-4">
            <div class="panel panel-default">
                  <div class="panel-heading">
                        <p><span class="glyphicon glyphicon-import" aria-hidden="true"></span><strong>TO-DO</strong> : SEMANAL</p>
                  </div>
                  <div class="panel-body">
                        <form action="c08imp" method="post" name="importar" id="form1" enctype="multipart/form-data">
                              <div class="form-group">
                                    <ol>
                                          <li>Sacar un reporte <strong>To-Do</strong> y grabarlo en formato <strong>.csv</strong></li>
                                          <li>Selecciona el archivo</li>
                                          <li>Importar</li>
                                    </ol>
                                    <hr />
                                    <label class="btn btn-default" for="file">
                                          <input name="file" id="file" type="file" >
                                    </label>
                                    <hr />
                                    <p class="text-info">Este proceso puede tardar algunos minutos. Presione Importar y espere el resultado</p>
                                    <small id="a" class="text-info"></small>
                                    <div class="progress">
                                          <div id="mybar" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class=" text-right">
                                          <button type="submit" class="btn btn-sm btn-success" name="submittodo"><span class='glyphicon glyphicon-import'> </span> Importar</button>
                                          <a href="c08" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span>Regresar</a>
                                    </div>
                                    <hr />
                              </div>
                              <br />
                        </form>

                  </div>
            </div>
      </div>

      <div class="col-md-4">
            <div class="panel panel-default">
                  <div class="panel-heading">
                        <p><span class="glyphicon glyphicon-import" aria-hidden="true"></span><strong>SC ACTIVE</strong> : TRIMESTRAL </p>
                  </div>
                  <div class="panel-body">
                        <form action="c08imp" method="post" name="importar" id="form1" enctype="multipart/form-data">
                              <div class="form-group">
                                    <ol>
                                          <li>Sacar un reporte <strong>SC Active</strong> desde <a href="https://cdquery.planapps.org/DefaultWebQueryTool.aspx" target="_blank">Query-Tool</a> en formato <strong>.csv</strong></li>
                                          <li>Selecciona el archivo</li>
                                          <li>Importar</li>
                                    </ol>
                                    <hr />
                                    <label class="btn btn-default" for="filesc">
                                          <input name="filesc" type="file" >
                                    </label>
                                    <hr />
                                    <p class="text-info">Este proceso puede tardar algunos minutos. Presione Importar y espere el resultado</p>
                                    <small id="asc" class="text-info"></small>
                                    <div class="progress">
                                          <div id="mybarsc" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class=" text-right">
                                          <button type="submit" class="btn btn-sm btn-success" name="submitsc"><span class='glyphicon glyphicon-import'> </span> Importar</button>
                                          <a href="c08" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span>Regresar</a>
                                    </div>
                                    <hr />
                              </div>
                              <br />
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
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {

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
            $handle = fopen($file, "r");
            $e = 0;
            $i = 0;
            $s = 0;
            set_time_limit(0);
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {

                  $comtypearray=array("F","M");
                  if (in_array($data[3],$comtypearray)) {
                        for ($j=0; $j <=8 ; $j++) {
                              $data[$j] = preg_replace('/[^À-ÿA-z0-9áéíóúñÑ\s.%\/]/', '-', $data[$j]);
                        }
                        $query="replace into `scactive` (`SC Status`, `SC Number`, `SC Name`, `Gender`,   `DOB`,                                `Afiliation Level Name`, `CW`,       `PU Code`,  `PU Name`) VALUES "
                        ."                              ('$data[0]',   $data[1],   '$data[2]', '$data[3]', STR_TO_DATE('$data[4]', '%d/%m/%Y'), '$data[5]',              '$data[6]', '$data[7]', '$data[8]')";
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
                  . "$('#mybarsc').show();"
                  . "$('#mybarsc').css('width', '$p%');"
                  . "$('#mybarsc').text('$p%');"
                  . "$('#asc').text('$data[8] $data[2]');"
                  . "</script>";
                  flush();


            }
            echo "<script language='javascript'> "
            . "$('#mybarsc').css('width', '100%');"
            . "$('#mybarsc').text('100%');"
            . "$('#asc').text('Procesados con exito:$s.    Con error:$e');"
            . "</script>";

      }
}



include 'footer.php';
?>
