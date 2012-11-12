
<?php #if (is_admin()): ?>
  
  <?php 
    // global $pagenow, $post;
    // 
    // $query_string = 'TB_iframe=true';
    // $query_string = in_array($pagenow, array('post.php', 'post-new.php')) ? 'post_id=' . $post->ID . '&' . $query_string : $query_string;
    // 
    // array_push($attributes['class'], 'button', 'thickbox'); 
  ?>
  
  <!-- <a 
    id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>"
    href="<?php echo admin_url('media-upload.php?' . $query_string); ?>"
    <?php echo piklist_form::attributes_to_string($attributes); ?>
  >
    <?php echo __('Upload or View'); ?>
  </a> -->
  
<?php #else: ?>

  <input 
    type="file"
    id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" 
    name="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"
    <?php echo piklist_form::attributes_to_string($attributes); ?>
  />
  
<?php # endif; ?>