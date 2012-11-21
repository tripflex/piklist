
<div class="wrap">

  <?php if ($title && $icon) screen_icon($icon); ?>

  <?php if (!empty($tabs) && count($tabs) > 1): ?>
    
    <h2 class="nav-tab-wrapper">

      <?php _e($title); ?>
      
      <?php if (isset($single_line) && !$single_line): ?>
        
        <hr class="piklist-tab-divider" />
        
      <?php endif; ?>
      
      <?php foreach ($tabs as $tab): ?>
        
        <?php
          parse_str($_SERVER['QUERY_STRING'], $url_defaults);
          
          $url = array_merge(
                  $url_defaults
                  ,array(
                    'page' => $_REQUEST['page']
                    ,'tab' => isset($tab['page']) ? $tab['page'] : false
                  )
                );      
        ?>
        
        <a class="nav-tab <?php echo (isset($tab['page']) && $_REQUEST['tab'] == $tab['page']) || (!isset($_REQUEST['tab']) && !isset($tab['page'])) ? 'nav-tab-active' : null; ?>" href="?<?php echo http_build_query(array_filter($url)); ?>">
          <?php echo $tab['title']; ?>
        </a>
        
      <?php endforeach;?>
      
    </h2>

  <?php elseif ($title): ?>
    
    <h2><?php _e($title); ?></h2>
    
  <?php endif; ?>

  <?php if (isset($setting) && !empty($setting)): ?>
  
    <?php settings_errors(); ?>
  
    <form action="<?php echo admin_url('options.php'); ?>" method="post">

      <?php settings_fields($setting); ?>

      <?php do_settings_sections($setting); ?>
    
      <?php do_action('piklist_settings_form'); ?>

      <?php if ($save): ?>
        
        <?php submit_button(__('Save Changes')); ?>
        
      <?php endif; ?>
    
    </form>
    
  <?php elseif ($page_sections): ?>

    <?php foreach ($page_sections as $page_section): ?>
      
      <?php if (piklist::dashes($page_section['tab']) == '' || (isset($_REQUEST['tab']) && piklist::dashes($page_section['tab']) == $_REQUEST['tab'])): ?>
      
        <?php piklist::render($page_section['path'] . '/parts/admin-pages/' . $page_section['part']); ?>
      
      <?php endif; ?>
      
    <?php endforeach; ?>
    
  <?php endif; ?>
  
</div>
