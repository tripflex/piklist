<?php
/*  
Title: Hello World
Description: "Hello World from ______"
*/
echo $before_widget; ?>

  <?php echo $before_title; ?>
  
    <?php echo __('Hello World from','piklist') . ' ' . $settings['from']; ?>!
  
  <?php echo $after_title; ?>
    
    <p>
      <?php _e('This is a sample widget from', 'piklist'); ?> <a href="http://piklist.com" target="_blank"><?php _e('Piklist','piklist'); ?></a>
    </p>
    
<?php echo $after_widget; ?>
