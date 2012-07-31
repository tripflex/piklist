
<?php
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'piklist'
    ,'field' => 'fields_id'
    ,'value' => $fields_id
    ,'widget' => false
  ));
?>

<script type="text/javascript">

  if (typeof piklist_fields == 'undefined')
  {
    var piklist_fields = [];
  }

  piklist_fields['<?php echo $fields_id; ?>'] = <?php echo json_encode($fields); ?>;

</script>