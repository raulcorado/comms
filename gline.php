<?php
/*
parametros:
$id="";
$field1="";
$data="";
$groups="";
$pattern="";
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
            type: 'line',
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
      },
      point: {
            show: true
      },
});
</script>
