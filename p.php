<?php
include 'secure.php';
include "app/connection.php"

include "header.php";
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
