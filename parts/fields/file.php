<?php

  if(is_admin())
  {
    wp_enqueue_media();
  }
  
  $value = is_array($value) || empty($value) ? $value : array($value);
  if (empty($value)):
?>
  <input 
    type="hidden" 
    id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" 
    name="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"
  />
<?php
  else:
    for ($index = 0; $index < count($value); $index++):
?>
  <input 
    type="hidden" 
    id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" 
    name="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"
    value="<?php echo esc_attr($value[$index]); ?>" 
  />
<?php 
    endfor;
  endif; 
?>



<?php if (isset($options['basic']) || !is_admin()): ?>

  <input 
    type="file"
    id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" 
    name="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"
    <?php echo piklist_form::attributes_to_string($attributes); ?>
  />
  
<?php else: ?>

  <a 
    href="#" 
    class="button piklist-upload-file-button"
    title="<?php _e(isset($options['title']) ? $options['title'] : 'Add Media'); ?>"
  >
    <span class="wp-media-buttons-icon"></span> <?php _e(isset($options['button']) ? $options['button'] : 'Add Media'); ?>
  </a>
  
<?php endif; ?>

<div class="piklist-upload-file-preview">

  <ul class="attachments">

    <?php 
      if (!empty($value)):
        foreach ($value as $attachment_id): 
          $image = wp_get_attachment_image_src($attachment_id, 'thumbnail', false, true);
    ?>

      <li class="attachment selected">
     		<div class="attachment-preview <?php echo (int) $image[1] > (int) $image[2] ? 'landscape' : 'portrait'; ?>">
   				<div class="thumbnail">
   					<div class="centered">
   					  <a href="#">
                <img src="<?php echo $image[0]; ?>" />
              </a>
   					</div>
   				</div>
   				<a class="check" href="#" title="Deselect" data-attachment-id="<?php echo $attachment_id; ?>" data-attachments="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"><div class="media-modal-icon"></div><span><?php _e('Remove'); ?></span></a>
     		</div>
     	</li>

    <?php 
        endforeach;
      endif;
    ?>

  </ul>

</div>