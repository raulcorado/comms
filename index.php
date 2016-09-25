<?php
include 'secure.php';
include 'header.php';
include 'app/connection.php';
?>


<br />
<h1><?php echo $_SESSION['email']; ?></h1>
<hr />
<p><?php echo $_SESSION['email']; ?></p>
<p>Haga clic en el menú</p>
<p>Al terminar dé <strong>cerrar-sesion</strong> en la barra de opciones.</p>
<br />
<br />
<br />
<a href="logout.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-log-out" aria-hidden="true">  </span>  Salir</a>

<?php
include 'footer.php';
?>
