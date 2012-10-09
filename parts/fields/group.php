<?php 
  foreach ($fields as $column)
  {
    $column['template'] = 'field';
    $column['child_field'] = true;

    if (!isset($column['scope']) || is_null($column['scope']))
    {
      if (isset($column['save_as']) && isset($value[$column['save_as']]))
      {
        $column['value'] = $value[$column['save_as']];
      }
      
      if (isset($value[$column['field']]))
      {
          $column['value'] = $value[$column['field']];
      }

      $column['field'] = (empty($field) ? '' : $field . '][' . ($index ? $index : '0') . '][') . $column['field'];
      $column['scope'] = $scope;
    }

    piklist('field', $column);
  }
?>