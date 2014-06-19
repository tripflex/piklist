
<div class="<?php echo esc_attr($type); ?>">

  <?php if (is_array($messages)): ?>
    
    <?php foreach ($messages as $message): ?>

      <p><?php echo $message; ?></p>

    <?php endforeach; ?>
  
  <?php else: ?>
    
    <p>
      <?php echo $message; ?>
    </p>

  <?php endif; ?>

</div>
