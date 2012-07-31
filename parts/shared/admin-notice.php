
<?php $prefix = $type == 'error' ? '<strong>' . __('ERROR:') . '</strong> ' : ''; ?>

<div class="<?php echo $type; ?>">

  <?php if (is_array($message)): ?>
    
    <ul>
      <?php foreach ($message as $line): ?>
        <li><?php echo $prefix; ?><?php _e($line); ?></li>
      <?php endforeach; ?>
    </ul>
  
  <?php else: ?>
    
    <p>
      <?php echo $prefix; ?><?php _e($message); ?>
    </p>

  <?php endif; ?>

</div>
