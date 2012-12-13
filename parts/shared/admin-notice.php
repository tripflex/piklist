
<?php $prefix = $type == 'error' ? '<strong>' . __('ERROR:','piklist') . '</strong> ' : ''; ?>

<div class="<?php echo $type; ?>">

  <?php if (is_array($message)): ?>
    
    <ul>
      <?php foreach ($message as $line): ?>
        <li><?php echo $prefix . $line; ?></li>
      <?php endforeach; ?>
    </ul>
  
  <?php else: ?>
    
    <p>
      <?php echo $prefix . $message; ?>
    </p>

  <?php endif; ?>

</div>
