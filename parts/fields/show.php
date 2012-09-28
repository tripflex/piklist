
<?php if (isset($value) && !empty($value)): ?>

  <?php if (is_array($value)): ?>

    <?php if (count($value) > 1 ): ?>
  
      <ol id="<?php echo piklist_form::get_field_id($field, $scope, $index); ?>">
        <li>
        <?php echo implode('</li><li>', $value); ?>
        </li>
      </ol>

    <?php else: ?>

      <?php echo implode($value); ?>

     <?php endif; ?>

  <?php else: ?>

    <div id="<?php echo piklist_form::get_field_id($field, $scope, $index); ?>">

      <?php echo $type == 'editor' ? wpautop($value) : $value ; ?>

    </div>

  <?php endif; ?>

<?php else: ?>
  
  <em>&mdash;</em>
  
<?php endif; ?>
