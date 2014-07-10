
<?php if ((isset($options['basic']) && $options['basic'] == true)  || !is_admin()): ?>

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
    title="<?php _e(isset($options['modal_title']) ? $options['modal_title'] : 'Add Media'); ?>"
  >
    <span class="wp-media-buttons-icon"></span> <?php _e(isset($options['button']) ? $options['button'] : 'Add Media'); ?>
  </a>
  
<?php endif; ?>

<div class="piklist-upload-file-preview piklist-field-preview">
  
  <?php
    $value = array_values(array_filter(is_array($value) ? $value : (empty($value) ? array() : array($value))));
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
  
  <ul class="attachments">

    <?php 
      if (!empty($value)):
        foreach ($value as $attachment_id): 
          $mime_type = get_post_mime_type($attachment_id);
          if ($mime_type):
            if (in_array($mime_type, array('image/jpeg', 'image/png', 'image/gif'))):
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
            else:
              $attachment_path = get_attached_file($attachment_id);
              $file_type = wp_check_filetype($attachment_path, wp_get_mime_types());

              $icon = includes_url() . 'images/crystal/' . substr($file_type['type'], 0, strpos($file_type['type'], '/')) . '.png';
              $icon = file_exists($icon) ? $icon : includes_url() . 'images/crystal/document.png'; 
    ?>
    
              <li class="attachment selected">
                 <div class="attachment-preview landscape type-<?php echo substr($file_type['type'], 0, strpos($file_type['type'], '/')); ?> subtype-<?php echo substr($file_type['type'], strpos($file_type['type'], '/') + 1); ?>">
                  <img src="<?php echo $icon; ?>" class="icon" />
                  <div class="filename">
                    <div><?php echo basename($attachment_path); ?></div>
                  </div>
                   <a class="check" href="#" title="Deselect" data-attachment-id="<?php echo $attachment_id; ?>" data-attachments="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"><div class="media-modal-icon"></div><span><?php _e('Remove'); ?></span></a>
                 </div>
               </li>
    
    <?php
            endif;
          endif;
        endforeach;
      endif;
    ?>

  </ul>

</div>