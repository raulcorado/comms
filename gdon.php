<?php
/*
parametros que recibe
$id
$field1
$data
*/
?>

<div id="<?php echo $id ?>"></div>
<script type="text/javascript">
var chart = c3.generate({
      bindto: '<?php echo "#$id" ?>',
      data: {
            x: '<?php echo $field1 ?>',
            columns: <?php echo $data ?>,
            groups: [<?php echo $groups ?>],
            type: 'donut',
            order: 'des',
      },
      color: {
            pattern: [<?php echo $pattern ?>]
      },
      gauge: {
            width: 40
      },
      //   legend: {
      //       position: 'right'
      //   },
      axis: {
            x: {
                  type: 'category'
            }
      },
      point: {
            show: true
      },
      tooltip: {
            format: {
                  value: function (value, ratio, id, index) {
                        return value;
                  }
            }
      }
});
</script>
