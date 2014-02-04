
<?php if ($field || (!$field && $type == 'group')): ?>
  
  <div id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" class="piklist-field-display">

    <?php
      if ((!$field && $type == 'group')):
      
        $value = array();
        
        foreach ($fields as $f):

          $value[$f['field']] = piklist_form::get_field_value($scope, $f, $scope, $object_id);
          
        endforeach;
      
      endif;
    ?>

    <?php if (is_array($value)): ?>

      <?php if (count($value) > 1 ): ?>

        <?php 
          if (piklist::is_flat($value)):          
      
            echo implode('<br />', $value);
    
          else:

            for ($i = 0; $i < count(current($value)); $i++):
            
              foreach ($value as $_key => $_value):
            
                echo $_value[$i] . '<br />';
            
              endforeach;
        
            endfor;
      
          endif; 
        ?>

      <?php else: ?>

        <?php echo implode($value); ?>

      <?php endif; ?>

    <?php else: ?>

      <?php echo $type == 'editor' ? wpautop($value) : $value ; ?>

    <?php endif; ?>

    <?php 
      piklist('field', array(
        'type' => 'hidden'
        ,'scope' => piklist::$prefix
        ,'field' => 'ignore' . ($scope ? '_' . $scope: '')
        ,'index' => rand()
        ,'value' => piklist_form::get_field_name($field, false, $index, $prefix)
      ));
    ?>

  </div>

<?php elseif (empty($value) && !$field): ?>
  
  <em>&mdash;</em>
  
<?php endif; ?>
