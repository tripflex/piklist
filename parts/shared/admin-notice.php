
<div class="<?php echo esc_attr($type); ?>">

  <?php if (is_array($message)): ?>
    
    <?php foreach ($message as $line): ?>

      <p><?php echo $line; ?></p>

    <?php endforeach; ?>
  
  <?php else: ?>
    
    <p>
      <?php echo $message; ?>
    </p>

  <?php endif; ?>

</div>
