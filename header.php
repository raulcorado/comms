<!DOCTYPE html>
<?php
// ini_set('display_errors',1);
include 'app/mivar.php';
?>
<html>
<head>
     <!--  500 0.6      <link rel="shortcut icon" href="i.ico"/>-->
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <!--        <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=0.5, user-scalable=no" />-->
     <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=0.3" />

     <title><?php echo MIAPP ?></title>

     <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
     <link href="css/c3.min.css" rel="stylesheet" type="text/css"/>
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
     <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>

     <link href="css/custom.css" rel="stylesheet" type="text/css"/>



     <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
     <script src="js/bootstrap.js" type="text/javascript"></script>

     <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
     <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>

     <script src="js/d3.min.js" type="text/javascript"></script>
     <script src="js/c3.min.js" type="text/javascript"></script>

     <script type="text/javascript">
     $(function () {
          $('[data-toggle="tooltip"]').tooltip()
     })
     </script>

</head>
<body>
     <div class="container">
          <nav class="navbar navbar-inverse navbar-fixed-top">
               <div class="container">
                    <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                         </button>
                         <a class="navbar-brand" href="./"><strong> <?php echo MIAPP ?></strong></a>
                    </div>

                    <div id="navbar" class="navbar-collapse collapse">
                         <ul class="nav navbar-nav">
                              <li class="dropdown">
                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>PROGRAMAS<span class="caret"></span></a>
                                   <ul class="dropdown-menu">
                                        <li class="divider"></li>
                                        <!-- <li><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span>01</a></li> -->
                                        <li><a href="c02"><span class="glyphicon glyphicon-check" aria-hidden="true"> </span>02-BENEFICIOS DE UN PROGRAMA</a></li>
                                        <li class="divider"></li>
                                        <li><a href="c03"><span class="glyphicon glyphicon-check" aria-hidden="true"> </span>03-BOLETA RI</a></li>
                                        <!-- <li><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span>04</a></li> -->
                                        <!-- <li><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span>05</a></li> -->
                                        <li class="divider"></li>
                                   </ul>
                              </li>
                              <li class="dropdown">
                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>PATROCINIO<span class="caret"></span></a>
                                   <ul class="dropdown-menu">
                                        <!-- <li class="divider"></li> -->
                                        <li><a href="c06"><span class="glyphicon glyphicon-check" aria-hidden="true"> </span>06-CARTA DE BIENVENIDA</a></li>
                                        <!-- <li class="divider"></li> -->
                                        <li><a href="c07"><span class="glyphicon glyphicon-check" aria-hidden="true"> </span>07-INTERCAMBIO DE CARTAS</a></li>
                                        <!-- <li class="divider"></li> -->
                                        <li><a href="c08"><span class="glyphicon glyphicon-check" aria-hidden="true"> </span>08-CONTENIDO DE CALIDAD DE CARTAS</a></li>
                                        <!-- <li class="divider"></li> -->
                                        <li><a href="c09"><span class="glyphicon glyphicon-check" aria-hidden="true"> </span>09-ACTUALIZACION SCI SCU</a></li>
                                        <!-- <li class="divider"></li> -->
                                        <li><a href="c10"><span class="glyphicon glyphicon-check" aria-hidden="true"> </span>10-CARTA DE DESPEDIDA FWL</a></li>
                                        <!-- <li class="divider"></li> -->

                                   </ul>
                              </li>
                              <!-- <li><a href="c08dashboard"><span class="glyphicon glyphicon-stats" aria-hidden="true"> </span>CUADRO DE MANDO</a></li> -->



                         </ul>
                         <ul class="nav navbar-nav navbar-right">
                              <!-- <li class="dropdown">
                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>CUADRO DE MANDO<span class="caret"></span></a>
                                   <ul class="dropdown-menu">
                                        <li class="divider"></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span>00-GENERAL</a></li>
                                        <li><a href="c02dashboard"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span>02-</a></li>
                                        <li><a href="c08dashboard"><span class="glyphicon glyphicon-stats" aria-hidden="true"> </span>08-</a></li>
                                        <li class="divider"></li>

                                        <li class="divider"></li>
                                   </ul>
                              </li> -->
                              <li class="dropdown">

                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span><?php echo strtoupper($_SESSION['username']) ?><span class="caret"></span></a>
                                   <ul class="dropdown-menu">
                                        <li class="divider"></li>
                                        <li><a href="users"><span class="glyphicon glyphicon-user" aria-hidden="true"> </span>USUARIO</a></li>
                                        <li class="divider"></li>
                                        <li><a href="logout"><span class="glyphicon glyphicon-log-out " aria-hidden="true"> </span>CERRAR SESION</a></li>
                                        <li class="divider"></li>
                                   </ul>
                              </li>
                         </ul>
                    </div>
               </div>
          </nav>
          <div class="container-fluid">
               <br>
               <a href="./"><img src="img/logo.png" width="180px" alt=""/></a>
               <hr>
