<?php
include 'secure.php';
include "header.php";
include "connection.php"
include "functions.php";
?>



<div class="text-danger">

<p>
      <?php
      echo Serial("select puname, est from generalcomms", "puname", "est");
      echo Cross("select puname, est from generalcomms", "puname", "est");
       ?>
</p>

</div>

<?php
include "footer.php";
?>
