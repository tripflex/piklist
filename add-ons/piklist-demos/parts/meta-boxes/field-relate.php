<?php
/*
Title: Post Relationships <span class="piklist-title-right">Order 10</span>
Post Type: piklist_demo
Order: 10
Priority: default
Context: side
Collapse: true
*/

  // Let's show the Meta Box 
  piklist('field', array(
    'type' => 'post-relate'
    ,'scope' => 'post'
    ,'template' => 'field'
  ));

?>

<?php // Displaying your related posts is as simple as using WP_Query with one extra parameter, post_belongs

    $args = array(
      'post_type' => 'post'
      ,'post_belongs' => $post_id
      ,'posts_per_page' => -1
      ,'post_status' => 'publish'
    );

?>

  <?php if ($post_id) : ?>

    <?php if (query_posts($args)) : ?>

      <h4><?php _e('Related Posts','piklist');?></h4>

        <ol>

          <?php query_posts($args); ?>

          <?php while (have_posts()) : the_post(); ?>

            <li><?php the_title();?></li>

          <?php endwhile; ?>

        </ol>

        <hr>

        <?php wp_reset_query();?>

    <?php endif; ?>
  
  <?php endif; ?>


<?php

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Meta Box'
  ));
  

?>