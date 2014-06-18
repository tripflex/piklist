<?php
/*
Title: Right Now
Capability: manage_options
Network: false
ID: dashboard_right_now
*/



global $wp_registered_sidebars;


if (version_compare($GLOBALS['wp_version'], '3.8-alpha', '>' ))
{
  piklist_dashboard_right_now_new();
}
else
{
  piklist_dashboard_right_now_old();
}


function piklist_dashboard_right_now_new()
{ ?>

  <div class="main">

    <h4><?php _e('Content'); ?></h4>

    <ul>

      <?php $post_types = get_post_types(array(), 'objects'); ?>

      <?php asort($post_types); ?>

      <?php foreach ($post_types  as $post_type) : ?>

            <li class="<?php echo strtolower($post_type->name); ?>">

              <?php $num_pages = wp_count_posts ($post_type->name); ?>

              <a href="<?php echo $post_type->name == 'attachment' ? 'upload.php' : 'edit.php?post_type=' . $post_type->name;?>">
                
                <?php echo number_format_i18n( $num_pages->publish ) . '&nbsp;' . $post_type->label; ?>
              
              </a>

            </li>

      <?php endforeach; ?>

    </ul>

    <h4><?php _e('Organization'); ?></h4>

    <ul>

        <?php $taxonomies = get_taxonomies(array(), 'objects'); ?>

        <?php foreach ($taxonomies as $taxonomy) : ?>

          <li class="<?php echo strtolower($post_type->name); ?>">

            <?php $num_pages = wp_count_terms($taxonomy->name); ?>

            <a href="edit-tags.php?taxonomy=<?php echo $taxonomy->name; ?>">
              
              <?php echo number_format_i18n( $num_pages) . '&nbsp;' . $taxonomy->label; ?>
            
            </a>

          </li>

        <?php endforeach; ?> 

    </ul>

    <h4>

      <?php $comments = wp_count_comments(); ?>

      <?php echo $comments->total_comments . '&nbsp;' . __('Comments'); ?>

    </h4>

    <ul>

      <li>

        <a href="edit-comments.php?comment_status=approved">

          <span class="approved-count"><?php echo $comments->approved . '&nbsp;' . __('Approved'); ?></span>

        </a>

      </li>

      <li>

        <a href="edit-comments.php?comment_status=moderated">

          <span class="pending-count"><?php echo $comments->moderated . '&nbsp;' . __('Pending'); ?></span>

        </a>

      </li>

      <li>

        <a href="edit-comments.php?comment_status=spam">

          <span class="spam-count"><?php echo $comments->spam . '&nbsp;' . __('Spam'); ?></span>

        </a>

      </li>


      <?php $elements = apply_filters('dashboard_glance_items', array()); ?>
  
      <?php if ($elements) : ?>

        <?php echo '<li>' . implode( "</li>\n<li>", $elements ) . "</li>\n"; ?>

      <?php endif; ?>


    </ul>

    <?php $theme = wp_get_theme(); ?>

    <?php if (current_user_can('switch_themes')) : ?>

      <?php $theme_name = sprintf('<a href="themes.php">%1$s</a>', $theme->display('Name')); ?>
  
    <?php else : ?>

      <?php $theme_name = $theme->display('Name'); ?>

    <?php endif; ?>

    <p><?php printf( __( 'WordPress %1$s running %2$s theme.' ), get_bloginfo( 'version', 'display' ), $theme_name ); ?></p>

    <?php 
      if (!is_network_admin() && !is_user_admin() && current_user_can('manage_options') && '1' != get_option('blog_public'))
      {
        $title = apply_filters('privacy_on_link_title', __('Your site is asking search engines not to index its content'));
        $content = apply_filters('privacy_on_link_text' , __('Search Engines Discouraged'));

        echo "<p><a href='options-reading.php' title='$title'>$content</a></p>";
      }
    ?>

    <?php
      ob_start();
      do_action('rightnow_end');
      do_action('activity_box_end');
      $actions = ob_get_clean();
    ?>

    <?php if (!empty($actions)) : ?>

      <div class="sub">
    
        <?php echo $actions; ?>
  
      </div>
  
    <?php endif;?>

  </div>

<?php
}
?>


<?php function piklist_dashboard_right_now_old() 
{ ?>

  <div class="table table_content">

    <p class="sub"><?php _e('Content'); ?></p>

      <table>

        <tbody>

          <?php $post_types = get_post_types(array(), 'objects'); ?>

          <?php foreach ($post_types  as $post_type) : ?>

            <tr>

              <td class="first b b-<?php echo strtolower($post_type->label); ?>">

                <a href="edit.php">
                  <?php $num_pages = wp_count_posts ($post_type->name); ?>
                  <?php echo number_format_i18n( $num_pages->publish ); ?>
                </a>

              </td>

                <td class="t <?php echo strtolower($post_type->label); ?>">

                    <a href="<?php echo $post_type->name == 'attachment' ? 'upload.php' : 'edit.php?post_type=' . $post_type->name;?>">
                      <?php echo $post_type->label; ?>
                    </a>

                </td>

            </tr>

          <?php endforeach; ?>

        </tbody>

      </table>

      <hr color="#ececec" />

      <table>

        <tbody>

          <?php $comments = wp_count_comments(); ?>

          <tr class="first">

            <td class="b b-comments">

              <a href="edit-comments.php">

                <span class="total-count"><?php echo $comments->total_comments;?></span>

              </a>

            </td>

            <td class="last t comments">

              <a href="edit-comments.php"><?php _e('Comments'); ?></a>

            </td>

          </tr>

          <tr>

            <td class="b b_approved">

              <a href="edit-comments.php?comment_status=approved">

                <span class="approved-count"><?php echo $comments->approved;?></span>

              </a>

            </td>

            <td class="last t">

              <a href="edit-comments.php?comment_status=approved" class="approved"><?php _e('Approved'); ?></a>

            </td>

          </tr>

          <tr>

            <td class="b b-waiting">

              <a href="edit-comments.php?comment_status=moderated">

                <span class="pending-count"><?php echo $comments->moderated;?></span>

              </a>

            </td>

            <td class="last t">

              <a href="edit-comments.php?comment_status=moderated" class="waiting"><?php _e('Pending'); ?></a>

            </td>

          </tr>

          <tr>

            <td class="b b-spam">

              <a href="edit-comments.php?comment_status=spam">

                <span class="spam-count"><?php echo $comments->spam;?></span>

              </a>

            </td>

            <td class="last t">

              <a href="edit-comments.php?comment_status=spam" class="spam"><?php _e('Spam'); ?></a>

            </td>

          </tr>
       
        </tbody>

      </table>

  </div>

  <div class="table table_discussion">

    <p class="sub"><?php _e('Organization'); ?></p>

    <table>

      <tbody>

        <?php $taxonomies = get_taxonomies(array(), 'objects'); ?>

        <?php foreach ($taxonomies as $taxonomy) : ?>

          <tr>

            <td class="first b b-<?php echo strtolower($taxonomy->name); ?>">

              <a href="edit.php">
                <?php $num_pages = wp_count_terms($taxonomy->name); ?>
                <?php echo number_format_i18n( $num_pages); ?>
              </a>

            </td>

            <td class="t <?php echo strtolower($taxonomy->name); ?>">

                <a href="edit-tags.php?taxonomy=<?php echo $taxonomy->name; ?>">
                  <?php echo $taxonomy->label; ?>
                </a>

            </td>

          </tr>

        <?php endforeach; ?>      

      </tbody>

    </table>
    
  </div>


  <div class="versions">

    <p>

    <?php

      $theme = wp_get_theme();

      if ($theme->errors())
      {
        if (!is_multisite() || is_super_admin())
        {
          echo '<span class="error-message">' . __('ERROR: The themes directory is either empty or doesn&#8217;t exist. Please check your installation.') . '</span>';
        }
      }
      elseif  (!empty($wp_registered_sidebars))
      {
        $sidebars_widgets = wp_get_sidebars_widgets();
        $num_widgets = 0;
        foreach ((array) $sidebars_widgets as $k => $v )
        {
          if ('wp_inactive_widgets' == $k || 'orphaned_widgets' == substr( $k, 0, 16 ))
          {
            continue;
          }
            
          if (is_array($v))
          {
            $num_widgets = $num_widgets + count($v);
          }
            
        }

        $num = number_format_i18n($num_widgets);

        $switch_themes = $theme->display('Name');

        if (current_user_can('switch_themes'))
        {
          $switch_themes = '<a href="themes.php">' . $switch_themes . '</a>';
        }
          
        if (current_user_can('edit_theme_options'))
        {
          printf(_n('Theme <span class="b">%1$s</span> with <span class="b"><a href="widgets.php">%2$s Widget</a></span>', 'Theme <span class="b">%1$s</span> with <span class="b"><a href="widgets.php">%2$s Widgets</a></span>', $num_widgets), $switch_themes, $num);
        }
        else
        {
          printf(_n('Theme <span class="b">%1$s</span> with <span class="b">%2$s Widget</span>', 'Theme <span class="b">%1$s</span> with <span class="b">%2$s Widgets</span>', $num_widgets), $switch_themes, $num);
        }
      }
      else
      {
        if (current_user_can('switch_themes'))
        {
          printf(__('Theme <span class="b"><a href="themes.php">%1$s</a></span>'), $theme->display('Name') );
        }
        else
        {
          printf(__('Theme <span class="b">%1$s</span>'), $theme->display('Name'));
        }
      }
    ?>

    </p>

    <?php if (!is_network_admin() && !is_user_admin() && current_user_can('manage_options') && '1' != get_option('blog_public')) : ?>

      <?php $title = apply_filters('privacy_on_link_title', __('Your site is asking search engines not to index its content')); ?>
      <?php $content = apply_filters('privacy_on_link_text', __('Search Engines Discouraged')); ?>

      <p>
        <a href='options-reading.php' title='<?php echo $title;?> '><?php echo $content;?></a>
      </p>

    <?php endif; ?>

    <?php update_right_now_message(); ?>

    <br class="clear" />

  </div>

  <?php do_action('rightnow_end'); ?>
  <?php do_action('activity_box_end'); ?>

<?php
}
?>