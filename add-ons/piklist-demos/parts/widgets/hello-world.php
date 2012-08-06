<?php
/*  
Title: Hello World
Description: "Hello World from ______"
*/
echo $before_widget; ?>

  <?php echo $before_title; ?>
  
    <?php echo __('Hello World from ') . $settings['from']; ?>!
  
  <?php echo $after_title; ?>
    
    <p>
      <?php _e('This is a sample widget from'); ?> <a href="http://piklist.com" target="_blank"><?php _e('Piklist'); ?></a>
    </p>
    
<?php echo $after_widget; ?>
