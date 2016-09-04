<?php
include 'secure.php';
include 'connection.php';


$permit=1;
// 1 admin
// 2 super user <<<<<<
// 3 usuario
// 4 visitante
if ($_SESSION[rolid]>$permit) {
      header("Location:403");
}




if (isset($_GET[id])) {
     if ($_GET[id] != $_SESSION['userid']) {
          if ($_SESSION['rolid'] != '1') {
               // echo 'ud no es admin';
               header("Location: users.php");
          }
     }

     $query = "select u.id, u.username, u.password, u.deptoid, r.rolid, u.nombrecomp, u.email, u.disabled from susua u, srolesusua r where u.id=r.userid"
     . " and u.id=$_GET[id]";

     $result = mysqli_query($link, $query);
     $row = mysqli_fetch_row($result);
}



if (isset($_POST['enviar'])) {
     $userid = $_POST['id'];
     $username = $_POST['username'];
     $nombrecomp = $_POST['nombrecomp'];
     $password = md5($_POST['password']);
     $email = $_POST['email'];
     $disabled = ((isset($_POST['disabled'])) ? 1 : 0);
     $deptoid = $_POST['deptoid'];
     $rolid = $_POST['rolid'];

     if ($_SESSION['rolid'] = 1) {
          //1 admins
          $query = "update susua set username='$username', nombrecomp='$nombrecomp', password='$password', email='$email', deptoid=$deptoid, disabled=$disabled where id=$userid";
          $result = mysqli_query($link, $query);
          $query = "update `srolesusua` set `rolid` = '$rolid' where `userid` = $userid";
          $result = mysqli_query($link, $query);
     } else {

          $query = "update susua set username='$username', nombrecomp='$nombrecomp', password='$password', email='$email', disabled=$disabled where id=$userid";
          $result = mysqli_query($link, $query);
     }
     header("Location: users.php");

}

include 'header.php';
?>


<div class="container">
     <div class="row">

          <div class="col-xs-12 col-lg-7">


               <h4>Editar usuario</h4>
               <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true">  </span>
                    </div>
                    <div class="panel-body">

                         <form role="form" action="userse" method="post"  class="form-horizontal" id="frmusuario">
                              <div class="form-group">
                                   <div class="col-xs-2">
                                        <label for="id">ID:</label>
                                        <input type="text" class="form-control input-sm" id="id" name="id" placeholder="USUARIO" value="<?php echo $row[0]; ?>" required="required" readonly>
                                   </div>
                                   <div class="col-xs-4">
                                        <label for="username">USUARIO:</label>
                                        <input type="text" class="form-control input-sm" id="username" name="username" placeholder="USUARIO" value="<?php echo $row[1]; ?>" required="required">
                                   </div>
                                   <div class="col-xs-4">
                                        <label for="password">CONTRASEÑA:</label>
                                        <input type="password" class="form-control input-sm" id="password" name="password" placeholder="CONTRASEÑA" value="<?php echo $_SESSION['password']; ?>" required="required">
                                   </div>
                              </div>
                              <div class="form-group">
                                   <div class="col-xs-offset-2 col-xs-4">
                                        <label for="deptoid">Departamento:</label>
                                        <select class="form-control input-sm" name="deptoid" required="required" <?php echo ($_SESSION['rolid'] <= 1 ? '' : ' readonly'); ?> >
                                             <!--                                    <select class="form-control input-sm" id="deptoid" name="deptoid" required="required" >-->
                                             <option value="" selected>selecciona</option>
                                             <?php
                                             $query = "select * from sdepto order by 2";


                                             $result = mysqli_query($link, $query);
                                             mysqli_data_seek($result, 0);
                                             while ($rowd = mysqli_fetch_row($result)) {
                                                  echo "<option value='" . $rowd[0] . "' " . ($rowd[0] == $row[3] ? "selected" : "") . ">" . $rowd[1] . "</option>";
                                             }
                                             ?>
                                        </select>
                                   </div>
                                   <div class="col-xs-4">
                                        <label for="rolid">Rol:</label>
                                        <select class="form-control input-sm" id="rolid" name="rolid" required="required" <?php echo ($_SESSION['rolid'] != '1' ? ' readonly' : ''); ?>>
                                             <option value="" selected>selecciona</option>
                                             <?php
                                             $query = "select * from sroles order by 2";
                                             $result = mysqli_query($link, $query);
                                             mysqli_data_seek($result, 0);
                                             while ($rowd = mysqli_fetch_row($result)) {
                                                  echo "<option value='" . $rowd[0] . "'" . ($rowd[0] == $row[4] ? "selected" : "") . ">" . $rowd[1] . "</option>";
                                             }
                                             ?>
                                        </select>
                                   </div>
                              </div>
                              <hr />
                              <div class="form-group">
                                   <div class="col-xs-6">
                                        <label for="nombrecomp">Nombre completo:</label>
                                        <input type="text" class="form-control input-sm" id="nombrecomp" name="nombrecomp" placeholder="Nombre Completo" value="<?php echo $row[5]; ?>" required="required">
                                   </div>
                                   <div class="col-xs-6">
                                        <label for="email">Correo electrónico:</label>
                                        <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Correo electrónico" value="<?php echo $row[6]; ?>" required="required">
                                   </div>
                              </div>

                              <div class="checkbox">
                                   <label><input type="checkbox"  id="disabled" name="disabled" <?php echo ($row[7] == 1 ? 'checked' : '') ?>> Deshabilitar</label>
                              </div>
                              <hr />

                              <button type="submit" class="btn btn-success" name="enviar"><span class='glyphicon glyphicon-ok'> </span>Grabar</button>
                              <a href="users" class="btn btn-danger"><span class='glyphicon glyphicon-remove'> </span>Cancelar</a>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>


<?php include 'footer'; ?>
