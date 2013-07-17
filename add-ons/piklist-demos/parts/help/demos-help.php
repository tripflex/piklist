<?php
/*
Title: Piklist Demos
Capability: manage_options
Page: piklist_demo,piklist_demo_page_piklist_demo_fields,profile
*/
?>

<p>
  <?php _e('The Piklist Demos post type is designed to show off Piklist features, test them, and demonstrate how to use them.', 'piklist');?>
</p>

<?php
  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Help tab'
  ));
?>