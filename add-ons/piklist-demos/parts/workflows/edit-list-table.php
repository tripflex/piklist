<?php
/*
Title: List Table
Order: 60
Flow: Edit Demo
*/
?>

<h3 class="demo-highlight">
  <?php _e('Fully customizable, sortable list tables can be created and placed anywhere with Piklist.','piklist');?>
</h3>

<?php
  
  piklist('include_meta_boxes', array(
    'piklist_meta_help'
    ,'piklist_meta_field_list_table'
    ,'piklist_meta_field_taxonomies'
    ,'piklist_meta_field_featured_image'
    ,'piklist_meta_field_relate'
    ,'piklist_meta_field_comments'
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));
  
?>