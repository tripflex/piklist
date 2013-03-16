
<!-- TODO: Show Associated -->
<!-- TODO: Remove Relationships if unset on form element -->

<ul class="wp-tab-bar">
  <li class="wp-tab-active"><a href="#"><?php _e('Most Recent'); ?></a></li>
  <li><a href="#"><?php _e('All'); ?></a></li>
</ul>

<div class="wp-tab-panel">

  <?php
    $query = new WP_Query(array(
      'post_type' => $scope
      ,'post_belongs' => $post->ID
      ,'posts_per_page' => -1
      ,'suppress_filters' => false
    ));

    $values = empty($query->posts) ? null : piklist(
      $query->posts
      ,array('ID', 'post_title')
    );
  
    piklist('field', array(
      'type' => 'checkbox'
      ,'scope' => 'piklist'
      ,'field' => 'post_id'
      ,'value' => $values
      ,'choices' => piklist(
        get_posts(array(
          'post_type' => $scope
          ,'numberposts' => 15
          ,'orderby' => 'date'
          ,'order' => 'DESC'
        ))
        ,array('ID', 'post_title')
      )
    ));
  ?>

</div>

<div class="wp-tab-panel">
  
  <?php
    piklist('field', array(
      'type' => 'checkbox'
      ,'scope' => 'piklist'
      ,'field' => 'post_id'
      ,'value' => $values
      ,'choices' => piklist(
        get_posts(array(
          'post_type' => $scope
          ,'numberposts' => -1
          ,'orderby' => 'title'
          ,'order' => 'ASC'
        ))
        ,array('ID', 'post_title')
      )
    ));
  ?>

  <!-- TODO: ADD Pagination -->
  
</div>

<!-- TODO: ADD Ajax Search -->

<?php
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'piklist'
    ,'field' => 'relate'
    ,'value' => 'has'
  ));
  
  wp_reset_query();
?>