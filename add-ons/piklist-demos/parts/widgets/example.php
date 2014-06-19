<?php
/*  
Title: Fields Demo
Description: An example of how to create a widget in Piklist
*/
echo $before_widget; ?>

  <?php echo $before_title; ?>
  
    <?php _e('Example Display Widget','piklist-demo'); ?>
  
  <?php echo $after_title; ?>
   
  <ul>
    <li><strong><?php _e('Text ~ Small','piklist-demo'); ?></strong> <?php echo $settings['demo_text_small']; ?></li>
    <li><strong><?php _e('Text','piklist-demo'); ?></strong> <?php echo $settings['demo_text']; ?></li>
    <li><strong><?php _e('Text ~ Large','piklist-demo'); ?></strong> <?php echo $settings['demo_text_large']; ?></li>
    <li><strong><?php _e('Textarea','piklist-demo'); ?></strong> <?php echo $settings['demo_textarea_large']; ?></li>
    <li><strong><?php _e('Select','piklist-demo'); ?></strong> <?php echo $settings['demo_select']; ?></li>
    <li><strong><?php _e('Radio','piklist-demo'); ?></strong> <?php echo $settings['demo_radio']; ?></li>
    <li><strong><?php _e('Checkbox','piklist-demo'); ?></strong> <?php echo $settings['demo_checkbox']; ?></li>
    <li style="color: <?php echo $settings['demo_color']; ?>;"><strong><?php _e('Color Picker','piklist-demo'); ?></strong> <?php echo $settings['demo_color']; ?></li>
    <li><strong><?php _e('Date Picker','piklist-demo'); ?></strong> <?php echo $settings['demo_date']; ?></li>
  </ul>
    
<?php echo $after_widget; ?>
