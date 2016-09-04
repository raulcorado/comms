<?php
/*
USO:
<?php
// GBAR INICIA
$id="g01";
$field1="puname";
$data="[json]";
$groups="[json]";
$pattern="'#f6511d','#00a6ed','#ffb400','#7fb800','#0d2c54'";
include "gbar.php";
// GBAR FINALIZA
?>
*/

?>

<div id="<?php echo $id ?>"></div>
<script type="text/javascript">
var chart = c3.generate({
      bindto: '<?php echo "#$id" ?>',
      data: {
            x: '<?php echo $field1 ?>',
            rows: <?php echo $data ?>,
            groups: [<?php echo $groups ?>],
            type: 'bar',
            order: 'desc',
      },
      grid: {
            x: {
                  show: true
            }
      },
      color: {
            pattern: [<?php echo $pattern ?>]
      },
      //   legend: {
      //       position: 'right'
      //   },
      axis: {
            x: {
                  type: 'category'
            },
            // y: {
            //     show: false
            // }
            // rotated: true
      },


      point: {
            show: true
      },
});
</script>
