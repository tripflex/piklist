<?php
/*
Title: Upload Fields <span class="piklist-title-right">Order 110</span>
Post Type: piklist_demo
Order: 110
Collapse: false
*/
  
  // Any field with the scope set to the field name of the upload field will be treated as related
  // data to the upload. Below we see we are setting the post_status and post_title, where the 
  // post_status is pulled dynamically on page load, hence the current status of the content is
  // applied. Have fun! ;)
  //
  // NOTE: If the post_status of an attachment is anything but inherit or private it will NOT be
  // shown on the Media page in the admin, but it is in the database and can be found using query_posts
  // or get_posts or get_post etc....  
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'post_status'
    ,'scope' => 'upload_simple'
    ,'description' => 'This is set to pull in post status automatically'
    ,'label' => 'Attachment Status'
    ,'value' => $post->post_status
  ));
  
  piklist('field', array(
    'type' => 'textarea'
    ,'field' => 'post_excerpt'
    ,'scope' => 'upload_simple'
    ,'label' => 'Attachment Notes'
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));
  
  piklist('field', array(
    'type' => 'file'
    ,'field' => 'upload_simple'
    ,'scope' => 'post'
    ,'label' => 'Attach File'
    ,'value' => 'Upload'
  ));



  $args = array( 
    'post_type' => 'attachment' 
    ,'numberposts' => -1
    ,'post_parent' => $post->ID 
    ,'post_status' => 'all'
  ); 
  
  $attachments = get_posts( $args );
  if ($attachments)
  {
    global $wp_post_statuses;
    remove_all_filters('get_the_excerpt'); // Since we're using the_excerpt for notes, we need to keep it clean.

    foreach ( $attachments as $post )
    { 
      setup_postdata($post); ?>

      <div id="pik_post_attachment_<?php echo $post->ID; ?>" class="piklist-field-container">
        <div class="piklist-label-container">
          <?php echo wp_get_attachment_link( $attachment->ID, 'thumbnail', false, true ); ?>     
        </div>
        <div class="piklist-field">
          <?php printf( __('%1$sOrder Status:%2$s %3$s','piklist'),'<strong>','</strong>',$wp_post_statuses[$post->post_status]->label); ?>
          <?php the_excerpt(); ?>
        </div>
      </div>
<?php
    }

  }

  
  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>