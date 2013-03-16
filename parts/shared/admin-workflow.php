
<?php 
  foreach ($path as $data)
  {
    if (strtolower($data['config']['header']) == 'true')
    {
      piklist::render($data['part'], array(
        'data' => $data
      ));
    }
  }
?>

<h2 class="nav-tab-wrapper">

  <?php foreach ($path as $data): ?>
    
    <?php if (strtolower($data['config']['header']) != 'true'): ?>
      
      <?php
      
        $saved = isset($post->ID);
      
        $data['config'] = array_filter($data['config']);
        
        $url_arguments = array(
          'flow' => $data['config']['flow_slug']
          ,'flow_page' => $data['config']['page_slug']
        );
        
        $url_arguments['post'] = isset($post->ID) ? $post->ID : (isset($_REQUEST['post']) ? (int) $_REQUEST['post'] : null);
        
        parse_str($_SERVER['QUERY_STRING'], $url_defaults);
    
        $url = array_merge($url_defaults, $url_arguments);

        unset($url['message']);
        
        if (isset($data['config']['redirect']))
        {
          $data['config']['redirect'] = apply_filters('piklist_workflow_redirect_url', $data['config']['redirect'], $workflow, $data);
          $url = admin_url($data['config']['redirect'] . (strstr($data['config']['redirect'], '?') ? '&' : '?') . http_build_query(array_filter($url)));
        }
        else if (!isset($data['config']['disable']))
        {
          if ($url_arguments['post'])
          {
            $page = 'post.php';

            unset($url['page']);

            $url['action'] = 'edit';
          }
          else
          {
            $page = 'admin.php';
          }
          
          $url = admin_url($page . '?' . http_build_query(array_filter($url)));

          // $url = 'href="' . $url . '"'; //$saved ? 'href="' . $url . '"' : null;
        }
      ?>
    
      <a class="nav-tab <?php echo $data['config']['active'] ? 'nav-tab-active' : null; ?>" href="<?php echo $url; ?>">
        <?php echo $data['config']['name']; ?>
      </a>
    
      <?php
        if ($data['config']['active'])
        {
          $active_data = $data;
        }
      ?>
      
    <?php endif; ?>
    
  <?php endforeach;?>
  
  <?php do_action('piklist_workflow_flow_append', $data['config']['flow_slug']); ?>
  
</h2>

<?php
  if ($active_data)
  {
    piklist::render($active_data['part'], array(
      'data' => $active_data
    ));
  }
?>
