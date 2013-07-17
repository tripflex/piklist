
<div class="wrap">

  <?php if ($icon) screen_icon($icon); ?>

  <?php if (isset($single_line) && !$single_line && isset($title)): ?>

    <h2><?php echo $title; ?></h2>

  <?php else: ?>

    <?php if (!empty($tabs) && count($tabs) > 1): ?>

      <h2 class="nav-tab-wrapper">

      <?php echo (isset($title)) ? $title : ''; ?>

    <?php elseif (isset($title)): ?>

      <h2><?php echo $title; ?></h2>

    <?php endif;?>

  <?php endif;?>
        
  <?php echo (isset($single_line) && !$single_line) ? '</h2>' : ''; ?>

  <?php if (!empty($tabs) && count($tabs) > 1): ?>

    <?php echo (isset($single_line) && !$single_line) ? '<h2 class="nav-tab-wrapper">' : ''; ?>
            
      <?php foreach ($tabs as $tab): ?>
        
        <?php
          parse_str($_SERVER['QUERY_STRING'], $url_defaults);

          foreach (array('message', 'paged') as $variable)
          {
            unset($url_defaults[$variable]);
          }
          
          $url = array_merge(
                  $url_defaults
                  ,array(
                    'page' => $_REQUEST['page']
                    ,'tab' => isset($tab['page']) ? $tab['page'] : false
                  )
                );     
        ?>
        <a class="nav-tab <?php echo (isset($tab['page']) && (isset($_REQUEST['tab'])) == $tab['page']) || (!isset($_REQUEST['tab']) && !isset($tab['page'])) ? 'nav-tab-active' : null; ?>" href="?<?php echo http_build_query(array_filter($url)); ?>">
          <?php echo $tab['title']; ?>
        </a>
        
      <?php endforeach;?>
      
    </h2>

  <?php elseif ($title): ?>
    
    </h2>
    
  <?php endif; ?>
  
  <?php 
    foreach ($page_sections as $page_section):
      if ($page_section['position'] == 'before' 
          && ((empty($page_section['tab']) && !isset($_REQUEST['tab'])) 
              || (!empty($page_section['tab']) && piklist('dashes', $page_section['tab']) == $_REQUEST['tab'])
              )
          ):
        piklist($page_section['part']);
      endif;
    endforeach;
  ?>

  <?php if (isset($setting) && !empty($setting)): ?>

    <?php if ($save): ?>
  
      <?php settings_errors(); ?>
    
      <form action="<?php echo admin_url('options.php'); ?>" method="post">

        <?php settings_fields($setting); ?>

    <?php endif; ?>

      <?php do_settings_sections($setting); ?>

    <?php if ($save): ?>
    
      <?php do_action('piklist_settings_form'); ?>
       
        <?php submit_button($save_text); ?>
         
      </form>

    <?php endif; ?>
  
  <?php endif; ?>
  
  <?php 
    foreach ($page_sections as $page_section):
      if ($page_section['position'] != 'before' 
          && ((empty($page_section['tab']) && !isset($_REQUEST['tab'])) 
              || (!empty($page_section['tab']) && piklist('dashes', $page_section['tab']) == $_REQUEST['tab'])
              )
          ):
        piklist($page_section['part']);
      endif;
    endforeach;
  ?>
  
</div>
