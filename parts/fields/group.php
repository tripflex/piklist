<?php 
  foreach ($fields as $column)
  {
    if (isset($column['columns']) || !isset($column['label']))
    {
      $column['template'] = 'field';
      $column['child_field'] = true;
    }
    
    if (!isset($column['scope']) || is_null($column['scope']))
    {
      if (isset($column['save_as']) && isset($value[$column['save_as']]))
      {
        $column['value'] = is_array($value[$column['save_as']]) ? current($value[$column['save_as']]) : $value[$column['save_as']];
      }
      
      if (isset($value[$column['field']]))
      {
        $column['value'] = is_array($value[$column['field']]) ? current($value[$column['field']]) : $value[$column['field']];
      }

      $column['field'] = (empty($field) ? '' : $field . ':' . ($index ? $index : '0') . ':') . $column['field'];
      $column['scope'] = $scope;
    }

    piklist('field', $column);
  }
?>