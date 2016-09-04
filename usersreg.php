<?php
// include 'secure.php';
include 'app/mivar.php';
include 'app/connection.php';

if (isset($_GET[msg])) {
      $msg = "<p class='text-danger'><span class='glyphicon glyphicon-bell' aria-hidden='true'></span>$_GET[msg]</p>";
}

if (isset($_POST['enviar'])) {

      $email = strchr($_POST[email], "@plan-international.org");

      if (!$email){
            $msg = "El correo $_POST[email] no parece un correo válido @plan-international.org";
      }
      else
      {
            $np = mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9);
            $nombrecomp = $_POST[nombre] . " " . $_POST[apellido];

            $query = "insert into susua (`nombrecomp`, `deptoid`, `email`, `password`, `username`) "
            . "values ('$nombrecomp', '$_POST[deptoid]', '$_POST[email]', MD5('$np'), '$_POST[username]')";

            $result = mysqli_query($link, $query);

            if (!$result) {
                  $msg = "Ocurrio un problema al agregar los datos. Quizá su usuario ya existe?";
            } else {
                  $msg = "SE REGISTRÓ CORRECTAMENTE. En unos momentos recibirá la contraseña a su correo: $_POST[email] ";

                  $query = "select username, password, email from susua where email='$_POST[email]'";
                  $result = mysqli_query($link, $query);


                  if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_array($result);

                        $username = $row['username'];
                        $password = $np;
                        $email = $row['email'];
                        $subject = $miapp;
                        $message = "
                        <html>
                        <head>
                        <title>$miapp</title>
                        </head>
                        <body>

                        <h4>$miapp</h4>
                        <p></p>
                        <p>Usuario: $username</p>
                        <p>Contraseña: <font color='red'> $password</font></p>
                        <h4>Por seguridad cambia tu contraseña en las opciones del programa</h4>
                        <p></p>
                        <p><a href='http://10.32.36.14/boleta'>Entrar a BOLETA RI</a></p>

                        </body>
                        </html>
                        ";

                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                        // More headers
                        $headers .= "From: $miapp <infoit@plan-international.org>" . "\r\n";
                        $headers .= "cc: raul.corado@plan-international.org" . "\r\n";

                        mail($_POST[email], $subject, $message, $headers);
                  }
            }

      }



      header("Location:usersreg.php?msg=$msg");
}

include 'header.php';
?>

<script type="text/javascript">
$(document).ready(function () {

      $('#frmusuario').submit(function () {
            $('#loading').show();
            $('#panel').fadeTo(1000, 0.4);
      });
});
</script>



<div class="container">
      <div class="row">

            <?php echo $msg ?>
            <img src="img/loading.gif" alt="" id="loading" style="display: none"/>
            <div class="col-xs-12 col-lg-6">


                  <h4>Registro de usuario NUEVO</h4>

                  <div class="panel panel-default" id="panel">
                        <div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true">  </span>
                        </div>
                        <div class="panel-body">
                              <div class="container-fluid">


                                    <form role="form" action="me.php" method="post"  class="form-horizontal" id="frmusuario">
                                          <hr />
                                          <div class="form-group">
                                                <div class="col-xs-6">
                                                      <label for="nombre">NOMBRE:</label>
                                                      <input type="text" class="form-control input-sm" id="nombre" name="nombre" required="required" placeholder="un solo Nombre">

                                                </div>
                                                <div class="col-xs-6">
                                                      <label for="apellido">APELLIDO:</label>
                                                      <input type="text" class="form-control input-sm" id="apellido" name="apellido" required="required" placeholder="un solo Apellido">
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <div class="col-xs-3">
                                                      <label for="username">USUARIO:</label>
                                                      <input type="text" class="form-control input-sm" id="username" name="username" required="required" placeholder="jperez">
                                                </div>
                                          </div>



                                          <hr />
                                          <div class="form-group">
                                                <div class="col-xs-3">


                                                      <label for="deptoid">DEPTO:</label>
                                                      <select class="form-control input-sm" id="deptoid" name="deptoid" required="required">
                                                            <option value="" selected>selecciona</option>
                                                            <?php
                                                            $query = "select s.id, s.depto from sdepto s order by 2";
                                                            $result = mysqli_query($link, $query);
                                                            mysqli_data_seek($result, 0);
                                                            while ($row = mysqli_fetch_row($result)) {
                                                                  echo "<option value='$row[0]'>$row[1]</option>";
                                                            }
                                                            ?>
                                                      </select>
                                                </div>
                                          </div>
                                          <hr />
                                          <div class="form-group">
                                                <div class="col-xs-8">
                                                      <label for="email">CORREO:</label>
                                                      <input type="email" class="form-control input-sm" id="email" name="email" placeholder="nombre.apellido@plan-international.org" required="required">
                                                      <p>Se enviará tu correo las instrucciones de como ingresar y como cambiar una nueva contraseña</p>

                                                </div>
                                          </div>



                                          <hr />

                                          <button type="submit" class="btn btn-success" id="enviar" name="enviar"><span class='glyphicon glyphicon-ok'> </span>Enviar solicitud</button>
                                          <a href="index.php" class="btn btn-danger"><span class='glyphicon glyphicon-remove'> </span>Cancelar</a>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>


<?php include 'footer'; ?>
