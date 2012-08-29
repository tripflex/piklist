<?php if ($list): ?>
  
  <<?php echo isset($list_type) ? $list_type : 'ul'; ?> class="piklist-field-list">

<?php endif; ?>

  <?php 

    foreach ($fields as $column)
    {
      $column['template'] = 'field';
      $column['child_field'] = true;

      if (is_null($column['scope']))
      {
        if (isset($column['save_as']) && isset($value[$column['save_as']]))
        {
          $column['value'] = $value[$column['save_as']];
        }
        if (isset($value[$column['field']]))
        {
            $column['value'] = $value[$column['field']];
        }

        $column['field'] = $field . '][' . ($index ? $index : '0') . '][' . $column['field'];
        $column['scope'] = $scope;

      }
      echo $list ? '<li>' : '';

        piklist('field', $column);

      echo $list ? '</li>' : '';
    }

  ?>

<?php if ($list): ?>
  
  </<?php echo isset($list_type) ? $list_type : 'ul'; ?>>

<?php endif; ?>