<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Form
{
  public static $templates = array(
    'field'  => '[field]'
    ,'default' => '[field]
                   [field_description_wrapper]
                     <span class="description">[field_description]</span>
                   [/field_description_wrapper]'
    ,'widget' => '[field_wrapper]
                    <div id="%1$s" class="%2$s piklist-field-container">
                      <div class="piklist-field-container-row">
                        <div class="piklist-label-container">
                          [field_label]
                        </div>
                        <div class="piklist-field">
                          [field]
                          [field_description_wrapper]
                            <span class="piklist-field-description">[field_description]</span>
                          [/field_description_wrapper]
                        </div>
                      </div>
                    </div>
                  [/field_wrapper]'
    ,'widget_classic' => '[field_wrapper]
                            <p id="%1$s" class="%2$s">
                              [field_label]
                              [field]
                              [field_description_wrapper]
                                <small>[field_description]</small>
                              [/field_description_wrapper]
                            </p>
                          [/field_wrapper]'
    ,'post_meta' => '[field_wrapper]
                      <div id="%1$s" class="%2$s piklist-field-container">
                        <div class="piklist-label-container">
                          [field_label]
                          [field_description_wrapper]
                            <span class="piklist-field-description description">[field_description]</span>
                          [/field_description_wrapper]
                        </div>
                        <div class="piklist-field">
                          [field]
                        </div>
                      </div>
                     [/field_wrapper]'
    ,'term_meta' => '<table class="form-table">
                      [field_wrapper]
                      <tr id="%1$s" class="%2$s">
                        <th scope="row" class="left">
                          [field_label]
                        </th>
                        <td>
                          [field]
                          [field_description_wrapper]
                            <span class="description">[field_description]</span>
                          [/field_description_wrapper]
                        </td>
                      </tr>
                      [/field_wrapper]
                    </table>'
    ,'term_meta_new' => '[field_wrapper]
                           <div id="%1$s" class="%2$s piklist-form-field">
                             [field_label]
                             [field]
                             [field_description_wrapper]
                               <p>[field_description]</p>
                             [/field_description_wrapper]
                           </div>
                         [/field_wrapper]'
    ,'user_meta' => '<table class="form-table">
                      [field_wrapper]
                      <tr id="%1$s" class="%2$s">
                        <th scope="row">
                          [field_label]
                        </th>
                        <td>
                          [field]
                          [field_description_wrapper]
                            <span class="description">[field_description]</span>
                          [/field_description_wrapper]
                        </td>
                      </tr>
                      [/field_wrapper]
                    </table>'
    ,'media_meta' => '</td></tr>
                       [field_wrapper]
                       <tr id="%1$s" class="%2$s">
                          <th valign="top" scope="row" class="label">
                          [field_label]
                         </th>
                         <td>
                           [field]
                           [field_description_wrapper]
                             <span class="description">[field_description]</span>
                           [/field_description_wrapper]
                         </td>
                       </tr>
                       [/field_wrapper]
                     '
    ,'theme' => '[field_wrapper]
                   <div id="%1$s" class="%2$s piklist-field-container">
                     <div class="piklist-field-container-row">
                       [field_label]
                       <p class="piklist-field">
                         [field]
                         [field_description_wrapper]
                           <span class="piklist-field-description">[field_description]</span>
                         [/field_description_wrapper]
                       </p>
                     </div>
                   </div>
                 [/field_wrapper]'
  );

  private static $template_shortcodes = array(
    'field_wrapper'
    ,'field_label'
    ,'field'
    ,'field_description_wrapper'
    ,'field_description'
  );
  
  private static $core_scopes = array(
    'post' => array(
      'ID'
      ,'menu_order'
      ,'comment_status'
      ,'ping_status'
      ,'pinged'
      ,'post_author'
      ,'post_category'
      ,'post_content'
      ,'post_date'
      ,'post_date_gmt'
      ,'post_excerpt'
      ,'post_name'
      ,'post_parent'
      ,'post_password'
      ,'post_status'
      ,'post_title'
      ,'post_type'
      ,'tags_input'
      ,'to_ping'
      ,'tax_input'
    )
    ,'post_meta' => array()
    ,'comment' => array(
      'comment_post_ID'
      ,'comment_author'
      ,'comment_author_email'
      ,'comment_author_url'
      ,'comment_content'
      ,'comment_type'
      ,'comment_parent'
      ,'user_id'
      ,'comment_author_IP'
      ,'comment_agent'
      ,'comment_date'
      ,'comment_approved'
    )
    ,'comment_meta' => array()
    ,'user' => array(
      'ID'
      ,'user_pass'
      ,'user_login'
      ,'user_nicename'
      ,'user_url'
      ,'user_email'
      ,'display_name'
      ,'nickname'
      ,'first_name'
      ,'last_name'
      ,'description'
      ,'rich_editing'
      ,'user_registered'
      ,'role'
      ,'user_role'
      ,'jabber'
      ,'aim'
      ,'yim'
    )
    ,'user_meta' => array()
    ,'taxonomy' => array()
    ,'term_meta' => array()
  );
  
  public static $save_ids = null;
  
  private static $field_alias = array(
    'datepicker' => 'text'
    ,'timepicker' => 'text'
    ,'colorpicker' => 'text'
    ,'submit' => 'button'
    ,'reset' => 'button'
  );
  
  private static $field_assets = array(
    'colorpicker' => array(
      'script' => 'wp-color-picker'
      ,'style' => 'wp-color-picker'
    )
    ,'datepicker' => array(
      'script' => 'jquery-ui-datepicker'
    )
  );
  
  private static $fields = null;
  
  private static $fields_defaults = array();
  
  private static $fields_rendered = array();
    
  private static $field_rendering = null;
  
  private static $field_wrapper_ids = array();
    
  public static $field_list_types = array(
    'checkbox'
    ,'radio'
    ,'add-ons'
    ,'file'
  );
    
  public static function _construct()
  {
    add_action('wp_loaded', array('piklist_form', 'wp_loaded'), 100);
    add_action('template_redirect', array('piklist_form', 'process_form'));
    add_action('admin_enqueue_scripts', array('piklist_form', 'scripts'));
    add_action('wp_enqueue_script', array('piklist_form', 'scripts'));
    add_action('post_edit_form_tag', array('piklist_form', 'add_enctype'));
    add_action('init', array('piklist_form', 'save_fields_actions'), 100);
    add_action('wp_ajax_piklist_form', array('piklist_form', 'ajax'));
  }
  
  public static function get($variable)
  {
    return isset(self::$$variable) ? self::$$variable : false;
  }
  
  public static function scripts()
  {
    global $wp_scripts;

    $jquery_ui_core = $wp_scripts->query('jquery-ui-core');

    wp_register_style('jquery-ui-core', piklist::$urls['piklist'] . '/parts/css/jquery-ui/jquery-ui.piklist.css', false, $jquery_ui_core->ver);
       
    wp_enqueue_style('jquery-ui-core');
    
    if (self::is_widget())
    {
      self::render_field_assets('all');
    }
  }
  
  public static function wp_loaded()
  {
    self::$templates = apply_filters('piklist_field_templates', self::$templates);
    
    add_shortcode('piklist_form', array('piklist_form', 'render_form'));
    
    foreach (self::$template_shortcodes as $template_shortcode)
    {
      add_shortcode($template_shortcode, array('piklist_form', 'template_shortcode'));
    }
  }
  
  public static function get_field_id($field, $scope = false, $index = false, $prefix = true)
  {
    if (!$field)
    {
      return false;
    }

    $prefix = $scope && $prefix ? piklist::$prefix : null;
    
    if (self::is_widget() && (!$scope || ($scope && ($scope != piklist::$prefix && $field != 'fields_id'))) && piklist_widget::widget())
    {
      $id = $prefix . piklist_widget::widget()->get_field_id(str_replace(':', '_', $field));
    }
    else
    {
      $id = $prefix . ($scope && $scope != piklist::$prefix ? $scope . '_' : null) . str_replace(':', '_', $field) . (is_numeric($index) ? '_' . $index : null);
    }
    
    self::$fields_rendered[$scope][$field]['id'] = !is_numeric($index) ? $id : null;
    
    return $id;
  }
  
  public static function get_field_name($field, $scope, $index = false, $prefix = true)
  {
    if (!$field)
    {
      return false;
    }

    $prefix = !in_array($scope, array(piklist::$prefix, false)) && $prefix ? piklist::$prefix : null;
    
    if (self::is_widget() && (!$scope || ($scope && ($scope != piklist::$prefix && $field != 'fields_id'))) && piklist_widget::widget())
    {
      $name = $prefix . piklist_widget::widget()->get_field_name(str_replace(':', '][', $field)). '[]';
    }
    else
    {
      $name = $prefix . ($scope ? $scope . (self::is_media() && isset($GLOBALS['piklist_attachment']) ? '_' . $GLOBALS['piklist_attachment']->ID : '') . '[' : null) . str_replace(':', '][', $field) . ($scope ? ']' : null) . (($scope && $scope != piklist::$prefix) || isset($index) ? '[]' : null); 
    }

    self::$fields_rendered[$scope][$field]['name'] = $name;
    
    return $name;
  }
  
  public static function get_field_object_id($field)
  {
    global $post, $tag_ID, $current_user, $wp_taxonomies;
    
    $id = null;
    
    switch ($field['scope'])
    {
      case 'post_meta':
      case 'taxonomy':
      
        if (isset($GLOBALS['piklist_attachment']))
        {
          $id = $GLOBALS['piklist_attachment']->ID;
        }
        elseif (isset($wp_taxonomies[$field['field']]) && isset($wp_taxonomies[$field['field']]->object_type) && $wp_taxonomies[$field['field']]->object_type[0] == 'user')
        {
          $id = isset(self::$save_ids['user']) ? self::$save_ids['user'] : (is_admin() && isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : $current_user->ID);
        }
        else
        {
          $id = isset(self::$save_ids['post']) ? self::$save_ids['post'] : (is_admin() ? ($post ? $post->ID : false) : false);
        }
      
      break;

      case 'term_meta':
            
        $id = $tag_ID;
      
      break;
    
      case 'user_meta':
            
        $id = isset($_REQUEST['user_id']) ? (int) $_REQUEST['user_id'] : $current_user->ID;
      
      break;

      case 'post':
      
        $id = is_admin() ? $post->ID : null;
      
      break;
    }
    
    return $id;
  }
  
  public static function get_field_value($scope, $field, $type = 'option', $id = false, $unique = false)
  {
    global $wpdb;
    
    $key = isset($field['save_as']) ? $field['save_as'] : (isset($field['field']) ? $field['field'] : null);
    $prefix = !in_array($scope, array(piklist::$prefix, false)) ? piklist::$prefix : null;
    $type = isset(self::$core_scopes[$type]) ? $type : 'option';
    
    if (!$id)
    {
      if (isset($_REQUEST[piklist::$prefix . $key]))
      {
        return $_REQUEST[piklist::$prefix . $key];
      }
      elseif (isset($_REQUEST[piklist::$prefix . $type][$key]))
      {
        return $_REQUEST[piklist::$prefix . $type][$key];
      }
      
      if (isset($field['object_id']))
      {
        $id = $field['object_id'];
      }
    }

    switch ($type)
    {
      case 'post':
        
        if ($id)
        {
          $post = get_post($id, ARRAY_A);
        }
        
        $attribute = isset($post[$field['field']]) ? $post[$field['field']] : (isset($field['value']) ? $field['value'] : false);
      
        return $attribute;
      
      break;
      
      case 'option':
    
        $options = get_option($scope);
        
        $keys = stristr($key, ':') ? explode(':', $key) : false;
        
        if (stristr($key, ':'))
        {
          $value = $options;
          $path = explode(':', $key);
          foreach ($path as $key)
          {
            if (isset($value[$key]))
            {
              $value = $value[$key];
            }
          }
        }
        else
        {
          $value = isset($options[$key]) ? $options[$key] : (isset($field['value']) ? $field['value'] : false);
        }
        
        return $value;
        
      break;
    
      case 'taxonomy':
        
        if ($id)
        {
          $terms = piklist(wp_get_object_terms($id, $key), apply_filters('piklist_taxonomy_value_key', 'term_id', $key));

          return !empty($terms) ? $terms : false;
        }
      
      break;
          
      case 'post_meta':
      case 'term_meta': 
      case 'user_meta': 

        if ($id)
        {
          $meta_key = $key ? $key : $scope;
          $meta_type = substr($type, 0, strpos($type, '_'));
          
          if (isset($field['multiple']) && $field['multiple'])
          {
            switch ($type)
            {
              case 'post_meta':
              
                $meta_table = $wpdb->postmeta;
                $meta_id_field = 'meta_id';
                $meta_id = 'post_id';
              
              break;

              case 'term_meta': 
              
                $meta_table = $wpdb->termmeta;
                $meta_id_field = 'meta_id';
                $meta_id = 'term_id';
              
              break;

              case 'user_meta':
              
                $meta_table = $wpdb->usermeta;
                $meta_id_field = 'umeta_id';
                $meta_id = 'user_id';
              
              break;
            }

            $keys = $wpdb->get_results($wpdb->prepare("SELECT {$meta_id_field} FROM $meta_table WHERE meta_key = %s AND $meta_id = %d", $meta_key, $id));
            $unique = count($keys) == 1 ? true : $unique;
          }
          
          if (strstr($meta_key, ':'))
          {                
            $meta = get_metadata($meta_type, $id, substr($meta_key, 0, strpos($meta_key, ':')), true);
            $path = explode(':', substr($meta_key, strpos($meta_key, ':') + 1));
            foreach ($path as $key)
            {
              if (isset($meta[$key]))
              {
                $meta = $meta[$key];
              }
            }
          }
          else
          {
            $meta = get_metadata($meta_type, $id, $meta_key, $unique);
          }
          
          if (!metadata_exists($meta_type, $id, $meta_key))
          {
            if (isset($field['value']))
            {
              $meta = $field['value'];
            }
            else
            {
              $meta = null;
            }
          }
          
          return $meta;
        }
      
      break;
    }
    
    return isset($field['value']) ? $field['value'] : null;
  }

  public static function get_field_wrapper_id($field)
  {
    $index = null;
    
    do {
      
      $id = piklist::$prefix . $field['field'] . ($index === null ? '' : '_' . $index);
      
      $index = $index === null ? 0 : $index + 1;
      
    } while (in_array($id, self::$field_wrapper_ids));
    
    array_push(self::$field_wrapper_ids, $id);
    
    return $id;
  }
  
  public static function get_template()
  {
    global $pagenow;

    if (!is_admin())
    {
      $wrapper = 'theme';
    }
    elseif (self::is_post())
    {
      $wrapper = 'post_meta';
    }
    elseif (self::is_media())
    {
      $wrapper = 'media_meta';
    }
    elseif (self::is_widget())
    {
      $wrapper = 'widget';
    }
    elseif ($type = self::is_term())
    {
      $wrapper = 'term_meta' . ($type == 'new' ? '_new' : '');
    }
    elseif (self::is_user())
    {
      $wrapper = 'user_meta';
    }
    else
    {
      $wrapper = 'default';
    }
    
    return $wrapper;
  }
  
  public static function get_field_show_value($field)
  {
    extract($field);
    
    if (isset($value) && !empty($value))
    {
      switch ($type)
      {
        case 'radio':
        case 'checkbox':   

          $value = is_array($value) ? $value : array($value);
          $_value = array();
          foreach ($value as $v)
          {
            if (isset($choices[$v]))
            {
              array_push($_value, $choices[$v]);
            }
          }
          $value = $_value;

        break;

        case 'select':

          $value = isset($choices[$value]) ? $choices[$value] : null;

        break;
      }
    }
        
    return $value;
  }
  
  public static function is_widget()
  {
    global $pagenow;

    return ($pagenow == 'widgets.php' || ($pagenow == 'admin-ajax.php' && ($_REQUEST['action'] == 'save-widget' || substr($_REQUEST['action'], 0, strlen('piklist_universal_widget')) == 'piklist_universal_widget')));
  }
  
  public static function is_post()
  {
    global $pagenow;
    
    return $pagenow == 'post.php' || $pagenow == 'post-new.php';
  }
  
  public static function is_term()
  {
    global $pagenow;
    
    if ($pagenow == 'edit-tags.php')
    {
      return isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ? 'edit' : 'new';
    }
    
    return false;
  }
  
  public static function is_user()
  {
    global $pagenow;
    
    return in_array($pagenow, array('user.php', 'user-new.php', 'user-edit.php', 'profile.php'));
  }
  
  public static function is_media()
  {
    global $pagenow;
    
    if (in_array($pagenow, array('async-upload.php', 'media.php', 'media-upload.php', 'media-new.php')))
    {
      return $pagenow == 'media.php' ? 'edit' : 'upload';
    }
    
    return false;
  }

  public static function add_enctype()
  {
    echo ' enctype="multipart/form-data" ';
  }
  
  public static function ajax() 
  {
    switch ($_REQUEST['method'])
    {
      case 'field':
        
        if (isset($_REQUEST['field']))
        {
          $field = $_REQUEST['field'];
          
          echo json_encode(array(
            'field' => self::render_field($field, true)
            ,'config' => $field
          ));
        }
      
      break;
    }

    die;
  }
  
  public static function render_field($field, $return = false)
  {  
    $field = wp_parse_args($field, array(
      'field' => false
      ,'type' => 'text'                     // field type
      ,'label' => false
      ,'description' => false
      ,'prefix' => true                     // prefix the field so it does not conflict with any other elements
      ,'scope' => null                      // how content is saved if you want it saved. post, post_meta, user, user_meta, comment, comment_meta (not required for Widget or Settings)
      ,'value' => null                      // default value
      ,'capability' => false                // one user role
      ,'add_more' => false                  // makes it an add more field
      ,'sortable' => false                  // makes it a sortable field
      ,'choices' => false                   // single array of values, or key => values
      ,'list' => true                       // wraps multiple in list
      ,'position' => false                  // start, end, wrap
      ,'template' => self::get_template()
      ,'wrapper' => false 
      ,'rows' => 1
      ,'columns' => null
      ,'embed' => false                     // internal
      ,'child_field' => false
      ,'label_position' => 'before'  
      ,'conditions' => false                // array of array of conditions
      ,'options' => false                   // tbd
      ,'object_id' => null                  // Is there an object this is being stored against?
      ,'on_post_status' => false 
      ,'on_comment_status' => false         // tbd
      ,'display' => false                   // show field value, not key (mostly internal)
      ,'group_field' => false               // whether or not a field is part if a group (mostly internal)
      ,'required' => false                  // Is the field required?
      ,'index' => null                      // internal 
      ,'multiple' => false                  // internal
      ,'attributes' => array(               // html attributes
        'class' => array()
        ,'title' => false                     // title
        ,'alt' => false                       // alt 
        ,'tabindex' => false                  // tabindex
        ,'columns' => null
        ,'value' => false
      )
      ,'tax_query' => array(
        'include_children' => true
        ,'field' => 'term_id'
        ,'operator' => 'IN'
      )
      ,'meta_query' => array(
        'compare' => '='
        ,'type' => 'CHAR'
      )
    ));
    
    // Should this field be rendered?
    if (($field['embed'] && !$return) || ($field['capability'] && !current_user_can($field['capability'])) || !isset($field['field']))
    {
      return false;
    }
    
    // Set default scopes based on enviroment
    if (is_null($field['scope']))
    {
      if (self::is_post())
      {
        $field['scope'] = 'post_meta';
      }
      elseif (self::is_media())
      {
        $field['scope'] = 'post_meta';
      }
      elseif (self::is_term())
      {
        $field['scope'] = 'term_meta';
      }
      elseif (self::is_user())
      {
        $field['scope'] = 'user_meta';
      }
    }
    
    // Set Defaults
    array_push(self::$fields_defaults, $field);
    
    // Determine if its a multiple type field
    if (in_array($field['type'], self::$field_list_types) || (in_array('multiple', $field['attributes'])))
    {
      $field['multiple'] = true;
    }
    
    // Manage Classes
    if (isset($field['attributes']['class']))
    {
      $field['attributes']['class'] = !is_array($field['attributes']['class']) ? explode(' ', $field['attributes']['class']) : $field['attributes']['class'];
    }
    else
    {
      $field['attributes']['class'] = array();
    }
    array_push($field['attributes']['class'], piklist_form::get_field_id($field['field'], $field['scope'], false, $field['prefix']));
    
    if (piklist_validate::errors($field['field'], $field['scope']))
    {
      array_push($field['attributes']['class'], 'piklist-error');
    }

    // Set Wrapper
    $wrapper = array(
      'id' => $field['type'] == 'map' ? null : self::get_field_wrapper_id($field)
      ,'class' => array()
    );
    
    // Set Columns
    if (is_numeric($field['columns']) && !$field['child_field'])
    {
      array_push($wrapper['class'], 'piklist-field-type-group piklist-field-column-' . $field['columns']);
    }
    
    if (isset($field['attributes']['columns']) && is_numeric($field['attributes']['columns']))
    {
      array_push($field['attributes']['class'], 'piklist-field-column-' . $field['attributes']['columns']);
      unset($field['attributes']['columns']);
    }

    if (isset($field['attributes']['wrapper_class']))
    {
      array_push($wrapper['class'], $field['attributes']['wrapper_class']);
    }
    
    // Check Statuses
    $status_types = apply_filters('piklist_status_types', array(
      'post'
    ));
    foreach ($status_types as $type)
    { 
      $status = $field['on_' . $type . '_status'];
      if (!empty($status))
      {
        $object = !empty(self::$save_ids) ? get_post(self::$save_ids[$type], ARRAY_A) : (array) $GLOBALS[$type];
        
        if (((is_admin() && isset($GLOBALS[$type])) || (!empty(self::$save_ids))) && isset($object['post_type']))
        {
          $status_list = piklist_cpt::get_post_statuses($object['post_type']);
          foreach (array('field', 'value', 'hide') as $status_display)
          {
            if (isset($status[$status_display]))
            {
              $status[$status_display] = is_array($status[$status_display]) ? $status[$status_display] : array($status[$status_display]);
              foreach ($status[$status_display] as $_status)
              {
                if (strstr($_status, '--'))
                {
                  $status_range = explode('--', $_status);
                  $status_range_start = array_search($status_range[0], $status_list);
                  $status_range_end = array_search($status_range[1], $status_list);

                  if (is_numeric($status_range_start) && is_numeric($status_range_end))
                  {
                    $status_slice = array();
                    for ($i = $status_range_start; $i <= $status_range_end; $i++)
                    {
                      array_push($status_slice, $status_list[$i]);
                    }
                              
                    array_splice($status[$status_display], array_search($_status, $status[$status_display]), 1, $status_slice);
                  }
                }
              }
            }
          }
        }
        
        if (isset($status['hide']) && isset($object[$type . '_status']) && piklist::check_in($status['hide'], $object[$type . '_status'] ? $object[$type . '_status'] : array('draft')))
        {
          return false;
        }
        elseif (isset($status['value']) && isset($object[$type . '_status']) && piklist::check_in($status['value'], $object[$type . '_status'] ? $object[$type . '_status'] : array('draft')))
        {
          $field['display'] = true;
        }   
      }
    }
    
    // Store Object ID
    if (!self::is_widget())
    {
      $field['object_id'] = piklist_form::get_field_object_id($field);
    }    
    
    // Get field value
    if (!$field['group_field'])
    {
      if (self::is_widget())
      {
        $stored_value = isset(piklist_widget::widget()->instance[$field['field']]) ? maybe_unserialize(piklist_widget::widget()->instance[$field['field']]) : $field['value'];
      }
      else
      {
        $stored_value = self::get_field_value($field['scope'], $field, $field['scope'], $field['object_id'], false);    
      }
      
      if (!$stored_value && !isset($field['attributes']['placeholder']) && !$field['multiple'])
      {
        $field['attributes']['placeholder'] = htmlspecialchars($field['value']);
      }
      elseif ($stored_value)
      {
        $field['value'] = $stored_value;
      }
    }

    // Check for nested fields
    if ($field['description'])
    {
      $field['description'] = self::render_nested_field($field['description'], $field, $field['scope']);
    }
    
    if (is_array($field['choices']) && !in_array($field['type'], array('select', 'multiselect')))
    {
      foreach ($field['choices'] as &$choice)
      {
        $choice = self::render_nested_field($choice, $field, $field['scope']);
      }
    }

    if ($field['conditions'])
    {
      if ($field['display'] && empty($field['value']))
      {
        return false;
      }
      
      foreach ($field['conditions'] as &$condition)
      {
        $condition['scope'] = isset($condition['scope']) ? $condition['scope'] : $field['scope'];
        $condition['id'] = piklist_form::get_field_id($condition['field'], $condition['scope'], false, $field['prefix']);
        
        array_push($wrapper['class'], 'piklist-field-' . (isset($condition['type']) && $condition['type'] ? $condition['type'] : 'condition'));
      }
    }
  
    // Set the field template 
    $field['template'] = $field['type'] == 'hidden' || $field['embed'] ? 'field' : $field['template'];
    $field['wrapper'] = preg_replace(
      array(
        '/ {2,}/'
        ,'/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
      )
      ,array(
        ' '
        ,''
      )
      ,sprintf(self::$templates[$field['template']], $wrapper['id'], implode(' ', $wrapper['class']))
    );


    
    $field = apply_filters('piklist_pre_render_field', $field);
    
    // Render the field
    self::$field_rendering = $field;
      
      self::$fields_rendered[$field['scope']][$field['field']] = $field;      
      
      $field_to_render = self::template_tag_fetch('field_wrapper', $field['wrapper']);

      $rendered_field = do_shortcode($field_to_render);
      
      switch ($field['position'])
      {
        case 'start':
      
          $rendered_field = piklist_form::template_tag_fetch('field_wrapper', $field['wrapper'], 'start') . $rendered_field;
          
        break;
        
        case 'end':
        
          $rendered_field .= piklist_form::template_tag_fetch('field_wrapper', $field['wrapper'], 'end');
        
        break;
        
        case 'wrap':
        
          $rendered_field = piklist_form::template_tag_fetch('field_wrapper', $field['wrapper'], 'start') . $rendered_field . piklist_form::template_tag_fetch('field_wrapper', $field['wrapper'], 'end');
        
        break;
      }
      
      $rendered_field = apply_filters('piklist_post_render_field', $rendered_field);
      
    self::$field_rendering = null;

    // Return the field as requested
    if ($return)
    {
      return $rendered_field;
    }
    else
    {
      echo $rendered_field;
    }
  }
  
  public static function save_fields($object = null)
  {
    if (!empty(self::$fields_rendered))
    {
      $fields_id = md5(serialize(self::$fields_defaults));
      
      if (current_user_can('manage_options'))
      {
        delete_transient(piklist::$prefix . $fields_id);
      }
      
      if (false === ($fields = get_transient(piklist::$prefix . $fields_id))) 
      {
        set_transient(piklist::$prefix . $fields_id, self::$fields_rendered, 60 * 60 * 24);
      }
      
      piklist::render('fields/fields', array(
        'fields_id' => $fields_id
        ,'fields' => self::$fields_rendered // NOTE: Should we filter out any attributes?
      ));

      self::$fields_defaults = self::$fields_rendered = array();
    }
  }

  public static function save_fields_actions()
  {
    $actions = array(
      'dbx_post_sidebar'
      ,'show_user_profile'
      ,'edit_user_profile'
      ,'piklist_settings_form'
      ,'media_meta'
    );

    foreach ($actions as $action) 
    {
      add_action($action, array('piklist_form', 'save_fields'), 101);
    }
    
    $taxonomies = get_taxonomies('', 'names'); 
    foreach ($taxonomies as $taxonomy) 
    {
      add_action($taxonomy . '_add_form', array('piklist_form', 'save_fields'), 101);
      add_action($taxonomy . '_edit_form', array('piklist_form', 'save_fields'), 101);
    }
  }

  public static function render_nested_field($content, $field, $scope)
  {
    preg_match_all("#\[field=(.*?)\]#i", $content, $matches);

    if (!empty($matches[1]))
    {
      for ($i = 0; $i < count($matches[1]); $i++)
      {
        $nested_field = false;

        foreach ($field['fields'] as $f)
        {
          if ($f['field'] == $matches[1][$i])
          {
            $nested_field = $f;
            break;
          }
        }
      
        if ($nested_field)
        {
          $content = str_replace(
            $matches[0][$i]
            ,self::render_field(
              wp_parse_args(array(
                  'scope' => $field['scope']
                  ,'field' => $nested_field['field']
                  ,'embed' => true
                  ,'prefix' => $field['prefix']
                  ,'value' => self::get_field_value($field['scope'], $nested_field, isset(self::$core_scopes[$field['scope']]) ? $field['scope'] : 'option')
                )
                ,$nested_field
              )
              ,true
            )
            ,$content
          );
        }
      }
    }
    
    return $content;
  }
  
  public static function render_field_assets($type)
  {
    if (is_admin())
    {
      wp_enqueue_media();
    }
    
    if ($type == 'all')
    {
      foreach (self::$field_assets as $assets)
      {
        if (isset($assets['script']))
        {
          wp_enqueue_script($assets['script']);
        }
        
        if (isset($assets['style']))
        {
          wp_enqueue_style($assets['style']);
        }
      }
    }
    elseif (isset(self::$field_assets[$type]))
    {
      if (isset(self::$field_assets[$type]['script']))
      {
        wp_enqueue_script(self::$field_assets[$type]['script']);
      }
      
      if (isset(self::$field_assets[$type]['style']))
      {
        wp_enqueue_style(self::$field_assets[$type]['style']);
      }
    }
  }
  
  public static function template_tag_fetch($template_tag, $template, $wrapper = false)
  {
    if (!strstr('[', $template) && isset(self::$templates[$template]))
    {
      $template = self::$templates[$template];
    }
    
    if ($wrapper == 'start')
    {
      $output = substr($template, 0, strpos($template, '[' . $template_tag));
    }
    elseif ($wrapper == 'end')
    {
      $output = substr($template, strpos($template, '[/' . $template_tag . ']') + strlen('[/' . $template_tag . ']'));
    }
    else
    {
      $output = strstr($template, '[' . $template_tag) ? substr($template, strpos($template, '[' . $template_tag), strpos($template, '[/' . $template_tag . ']') + strlen('[/' . $template_tag . ']') - strpos($template, '[' . $template_tag)) : $template;
    }
    
    return $output;
  }
  
  public static function template_shortcode($attributes, $content = '', $tag)
  {
    extract(shortcode_atts(array(
      'class' => array()
    ), $attributes));

    self::render_field_assets(self::$field_rendering['type']);

    $content = do_shortcode($content);
    $type = isset(self::$field_alias[self::$field_rendering['type']]) ? self::$field_alias[self::$field_rendering['type']] : self::$field_rendering['type'];

    switch ($tag)
    {
      case 'field_label':
      
        $content = self::template_label($type, self::$field_rendering);
        
      break;

      case 'field_description_wrapper':
      
        $content = isset(self::$field_rendering['description']) && !empty(self::$field_rendering['description']) ? $content : '';
      
      break;
      
      case 'field_description':

        $content = self::$field_rendering['display'] ? '' : self::$field_rendering['description'];
      
      break;
      
      case 'field':
        
        $content = '';
        
        if ((self::$field_rendering['add_more'] || self::$field_rendering['sortable']) && !self::$field_rendering['display'] && !self::$field_rendering['multiple'])
        {
          self::$field_rendering['attributes']['data-piklist-field-addmore'] = 'true';
          
          if (self::$field_rendering['sortable'] && !self::$field_rendering['add_more'])
          {
            self::$field_rendering['attributes']['data-piklist-field-addmore-actions'] = 'false';
          }
        }
        
        if (is_numeric(self::$field_rendering['columns'])) // && self::$field_rendering['child_field'])
        {
          self::$field_rendering['attributes']['data-piklist-field-columns'] = self::$field_rendering['columns'];
        }

        if (self::$field_rendering['display'])
        {
          self::$field_rendering['value'] = is_array(self::$field_rendering['value']) && count(self::$field_rendering['value']) == 1 ? self::$field_rendering['value'][0] : self::$field_rendering['value'];
          self::$field_rendering['value'] = self::get_field_show_value(self::$field_rendering);
          
          $content = self::template_field('show', self::$field_rendering);
        }
        elseif (self::$field_rendering['multiple'] || (!is_array(self::$field_rendering['value']) || count(self::$field_rendering['value']) == 1))
        {
          self::$field_rendering['value'] = is_array(self::$field_rendering['value']) && !self::$field_rendering['multiple'] ? (is_array(self::$field_rendering['value']) ? current(self::$field_rendering['value']) : self::$field_rendering['value']) : self::$field_rendering['value'];
          
          $content = self::template_field($type, self::$field_rendering);
        }
        else
        {   
          $values = is_array(self::$field_rendering['value']) && isset(self::$field_rendering['value'][0]) ? self::$field_rendering['value'] : array(self::$field_rendering['value']);
          $clone = self::$field_rendering;

          $index = 0;
          foreach ($values as $value)
          {
            $clone['value'] = $value;
            $clone['index'] = $index;

            $index++;
            
            $content .= self::template_field($type, $clone);
          }
        }
        
      break;
    }
    
    return $content;
  }
  
  public static function template_label($type, $field)
  {
    if (empty($field['label']))
    {
      return '';
    }
  
    $attributes = array(
      'for' => self::get_field_name($field['field'], $field['scope'], false, $field['prefix'])
      ,'class' => 'piklist' . ($field['child_field'] ? '-child' : '') . '-label piklist-label-position-' . $field['label_position'] . (isset($field['attributes']['label_class']) ? ' ' . $field['attributes']['label_class'] : '')
    );
    
    $label_tag = !$field['multiple'] || in_array('multiple', $field['attributes']) ? 'label' : 'span';    
    
    return '<' . $label_tag . ($label_tag == 'span' ? ' class="piklist-label" ' : ' ') . self::attributes_to_string($attributes) . '>' . self::field_label($field) . '</' . $label_tag . '>';
  }
 
  public static function template_field($type, $field)
  {
    $content = '';

    if ($field['child_field'])
    {
      if ($field['label_position'] == 'before' && $field['template'] == 'field')
      {
        $content .= self::template_label($type, $field);
      }
      
      $content .= piklist::render('fields/' . $type, $field, true);

      if ($field['label_position'] == 'after' && $field['template'] == 'field')
      {
        $content .= self::template_label($type, $field);
      }
    }
    else
    {
      $content .= piklist::render('fields/' . $type, $field, true);
    }
    
    return $content;
  }
  
  public static function field_label($field)
  {
    $label = '';

    $label .= $field['label'];
    $label .= !empty($field['required']) ? '<span class="piklist-required">*</span>' : null;
    $label .= isset($field['help']) ? '<div class="piklist-tooltip dashicons dashicons-editor-help" data-piklist-tooltip="' . $field['help'] . '"><span class="icon-help"></span></div>' : null;
  
    return $label;

  }
  
  public static function render_form($attributes, $content = '') 
  {
    extract(shortcode_atts(array(
      'form' => false
      ,'add_on' => false
    ), $attributes));


    if ($form)
    {
      if ($add_on && isset(piklist::$paths[$add_on]))
      {
        $paths[$add_on] = piklist::$paths[$add_on];
      }
      else
      {
        $paths = piklist::$paths[$add_on];
      }
      
      if (empty($paths))
      {
        return false;
      }

      foreach ($paths as $display => $path)
      {   
        if (in_array($form . '.php', piklist::get_directory_list($path . '/parts/forms')))
        {
          $data = get_file_data($path . '/parts/forms/' . $form . '.php', array(
                    'class' => 'Class'
                    ,'title' => 'Title'
                    ,'method' => 'Method'
                    ,'action' => 'Action'
                    ,'filter' => 'Filter'
                    ,'id' => 'ID'
                    ,'capability' => 'Capability'
                  ));

          if (!$data['capability'] || ($data['capability'] && current_user_can($data['capability'])))
          {
            $data['nonce'] = wp_create_nonce(plugin_basename(piklist::$paths['piklist'] . '/piklist.php'));
            $data['form'] = $path . '/parts/forms/' . $form;
            $data['ids'] = self::$save_ids;
            $data['form_id'] = $data['id'] ? $data['id'] : $form;
                        
            $content = piklist::render('fields/form', $data, true);
            
            return $content;
          }
        }
      }
    }
    
    return null;
  }
  
  public static function process_form($ids = null, $force = true)
  {
    if (isset($_REQUEST[piklist::$prefix]['nonce']) && wp_verify_nonce($_REQUEST[piklist::$prefix]['nonce'], plugin_basename(piklist::$paths['piklist'] . '/piklist.php')))
    {      
      self::save($ids);
      
      if (isset($_REQUEST[piklist::$prefix]['redirect']))
      {
        wp_redirect($_REQUEST[piklist::$prefix]['redirect'] . (!strstr($_REQUEST[piklist::$prefix]['redirect'], '?ID=') ? '?ID=' . self::$save_ids['post'] : null));
      }
    }
  }
  
  public static function save($ids = null)
  {
    global $wpdb, $wp_post_types, $wp_taxonomies;
    
    if (!isset($_REQUEST[piklist::$prefix]['fields_id']) || isset($_REQUEST[piklist::$prefix]['filter']) || !piklist_validate::check())
    {
      return false;
    }

    self::$fields = get_transient(piklist::$prefix . $_REQUEST[piklist::$prefix]['fields_id']);
    
    foreach (array('post', 'comment', 'user', 'taxonomy', 'post_meta', 'comment_meta', 'user_meta', 'term_meta') as $builtin)
    {
      if (isset($_REQUEST[piklist::$prefix . $builtin]['ID'][0]) && !isset($ids[$builtin]))
      {
        $ids[$builtin] = (int) $_REQUEST[piklist::$prefix . $builtin]['ID'][0];
      }
      
      $suffixed = false;
      foreach ($_REQUEST as $key => $value)
      {
        $prefix = $builtin . '_';
        if (substr($key, 0, strlen($prefix)) == $prefix)
        {
          $suffix = str_replace($prefix, '', $key);
          if (is_numeric($suffix))
          {
            $suffixed = $suffix;
            break;
          }
        }
      }
    
      $type = piklist::$prefix . $builtin;
      $request = $_REQUEST;
      $files = $_FILES;
      
      if (isset($files[$type]))
      {
        $request[$type] = self::save_upload($files[$type], $request[$type]);
      }
      
      $scope = $type . ($suffixed ? '_' . $suffixed : '');
      $data = isset($request[$scope]) ? $request[$scope] : array();
      
      // TODO: Handle multi-step forms, i.e. status showing fields/values/nothing
      $unset_fields = array();
      $unsent_fields = isset(self::$fields[$builtin]) ? self::fields_diff(self::$fields[$builtin], $data) : array();
      $ignore_fields = isset($request[piklist::$prefix]['ignore_' . $builtin]) ? $request[piklist::$prefix]['ignore_' . $builtin] : array();

      foreach ($unsent_fields as $unsent_field)
      {
        if (strstr($unsent_field, ':'))
        {                
          $path = explode(':', $unsent_field);
          if (in_array($path[0], $unsent_fields))
          {
            $tmp = &$unset_fields;
            foreach($path as $key) 
            {
              $tmp = &$tmp[$key];
            }
            $tmp = null;
            unset($tmp);
          }                
        }
        elseif (!is_numeric($unsent_field))
        {
          array_push($unset_fields, $unsent_field);
        }
      }
      
      switch ($builtin)
      {
        case 'post':
          
          if (!empty($data))
          {
            foreach ($data as $key => &$value)
            {
              $value = is_array($value) ? current($value) : $value;
            }
          
            if (isset($ids['post']))
            {
              $data['ID'] = $ids['post'];
            }
          
            $ids['post'] = self::save_object('post', $data, isset($request[piklist::$prefix]['post_id']) ? $request[piklist::$prefix]['post_id'] : false);
          }
          
        break;
      
        case 'post_meta':
        case 'term_meta':
        case 'user_meta':
          
          $meta_type = substr($builtin, 0, strpos($builtin, '_'));
          $id = $suffixed ? $suffixed : (isset($ids[$meta_type]) ? $ids[$meta_type] : null);
          
          if (empty($id)) 
          {
            break;
          }

          foreach ($data as $key => $value) 
          {
            delete_metadata($meta_type, $id, $key);

            if (is_array($value))
            {         
              if (!piklist::is_flat($value) && !isset($value[0]))
              {
                add_metadata($meta_type, $id, $key, $value);
              }
              else
              {
                if (count($value) > 1 && empty($value[0]))
                {
                  unset($value[0]);
                }
                
                foreach ($value as $meta)
                {
                  if (is_array($meta) && count($meta) == 1)
                  {
                    $meta = current($meta);
                  }
                  
                  add_metadata($meta_type, $id, $key, $meta);
                }
              }
            }
          }
          
          foreach ($unset_fields as $meta_key) 
          {
            if (!in_array($meta_key, $ignore_fields))
            {
              delete_metadata($meta_type, $id, $meta_key);
              add_metadata($meta_type, $id, $meta_key, true);
            }
          }
          
        break;
      
        case 'comment':
          
          if (!empty($data))
          {
            $ids['comment'] = self::save_object('comment', $data);
          }
          
        break;
      
        case 'user':
          
          if (!empty($data))
          {
            $ids['user'] = self::save_object('user', $data);
          }
          
        break;
      
        case 'taxonomy':
      
          if (isset($ids['post']) || isset($ids['user']))
          {
            if (!empty($data))
            {
              $taxonomies = array();

              foreach ($data as $taxonomy => $terms)
              {
                $taxonomy = isset(self::$fields['taxonomy'][$taxonomy]['save_as']) ? self::$fields['taxonomy'][$taxonomy]['save_as'] : $taxonomy;
              
                if (!isset($taxonomies[$taxonomy]))
                {
                  $taxonomies[$taxonomy] = array();
                }
              
                $terms = is_array($terms) ? $terms : array($terms);
                foreach ($terms as $term)
                {
                  if (!in_array($term, $taxonomies[$taxonomy]))
                  {
                    array_push($taxonomies[$taxonomy], is_numeric($term) ? (int) $term : $term);
                  }
                }
              }

              foreach ($taxonomies as $taxonomy => $terms)
              {
                if(isset($wp_taxonomies[$taxonomy]->object_type[0]))
                {
                  switch ($wp_taxonomies[$taxonomy]->object_type[0])
                  {
                    case 'user':

                      if (current_user_can('edit_user', $ids['user']) && current_user_can($wp_taxonomies[$taxonomy]->cap->assign_terms))
                      {
                        $id = $ids['user'];
                       }
                     
                    break;
                  
                    default:
                    
                      $id = $ids['post'];
                     
                    break;
                  }
                }

                wp_set_object_terms($id, $terms, $taxonomy, false);
                clean_object_term_cache($id, $taxonomy);
              }
            }
            
            foreach ($unset_fields as $taxonomy) 
            {
              if (!in_array($taxonomy, $ignore_fields))
              {
                switch ($wp_taxonomies[$taxonomy]->object_type[0])
                {
                  case 'user':

                    if (current_user_can('edit_user', $ids['user']) && current_user_can($wp_taxonomies[$taxonomy]->cap->assign_terms))
                    {
                      $id = $ids['user'];
                     }
                   
                  break;
                
                  default:
                  
                    $id = $ids['post'];
                   
                  break;
                }
                
                wp_set_object_terms($id, array(), $taxonomy, false);
                clean_object_term_cache($id, $taxonomy);
              }
            }
          }
      
        break;
      }
  
      do_action('piklist_save_field', $builtin, $data, isset(self::$fields[$builtin]) ? self::$fields[$builtin] : array());
    }

    self::$save_ids = $ids;

    if (isset($request[piklist::$prefix . 'relate']))
    {
      foreach ($request[piklist::$prefix . 'relate'] as $key => $value)
      {
        if (substr_compare($key, '_post_id', -strlen('_post_id'), strlen('_post_id')) === 0)
        {
          foreach ($request[piklist::$prefix . 'relate'][$key] as $post_id)
          {
            self::relate($ids['post'], $post_id);
          }
        }
        
        if (substr_compare($key, '_relate_remove', -strlen('_relate_remove'), strlen('_relate_remove')) === 0)
        {
          // TODO: Refactor into function
          // TODO: scope multiple fields by type
          // TODO: make checkboxes adapt on all tabs
          $remove = array_filter(explode(',', $request[piklist::$prefix . 'relate'][$key][0]));
          foreach ($remove as $has)
          {
            $found = $wpdb->get_var($wpdb->prepare('SELECT relate_id FROM ' . $wpdb->prefix . 'post_relationships WHERE post_id = %d AND has_post_id = %d', $ids['post'], $has));
            if ($found)
            {
              $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}post_relationships WHERE relate_id = %d", $found));
            }
          }
        }
      }
    }
  }
  
  public static function save_upload($files, $storage = array())
  {
    foreach ($files['name'] as $fid => $file_name)
    {
      foreach ($files['error'][$fid] as $index => $code)
      {
        if ($code === UPLOAD_ERR_OK)
        {
          $attach_id = media_handle_sideload(
                        array(
                          'name' => $file_name[$index]
                          ,'size' => $files['size'][$fid][$index]
                          ,'tmp_name' => $files['tmp_name'][$fid][$index]
                        )
                        ,0
                      );
        
          if ($attach_id)
          {
            if (!isset($storage[$fid]))
            {
              $storage[$fid] = array();
            }

            array_push($storage[$fid], $attach_id);
          }
        }
      }
    }

    return $storage;
  }
  
  public static function fields_diff($rendered, $request = array())
  {
    if (!is_array($rendered))
    {
      return array();
    }

    foreach($rendered as $key => $field) 
    {
      if (isset($field['display']))
      {
        unset($rendered[$key]);
      }
    }
    
    return array_filter(is_array($request) ? array_diff(array_keys($rendered), array_keys($request)) : array_keys($rendered), create_function('$a', 'return !strstr($a, ":");'));
  }
  
  public static function save_object($type, $data, $belongs_to = false)
  {
    $object = array();
    
    foreach (self::$core_scopes[$type] as $allowed)
    {
      if (isset($data[$allowed]) && !empty($data[$allowed]))
      {
        $object[$allowed] = is_array($data[$allowed]) && count($data[$allowed]) == 1 ? current($data[$allowed]) : $data[$allowed];
      }
    }
    
    switch ($type)
    {
      case 'post':
                
        $id = isset($object['ID']) ? wp_update_post($object) : wp_insert_post($object);
        
      break;
      
      case 'comment':
        
        if (!empty($object['comment_content']))
        {
          $id = isset($object['ID']) ? wp_update_comment($object) : wp_insert_comment($object);
        }
        
      break;
      
      case 'user':
        
        if (isset($object['user_pass']) && empty($object['user_pass']))
        {
          unset($object['user_pass']);
        }

        $id = isset($object['ID']) ? wp_update_user($object) : wp_insert_user($object);

        if ($object['user_role'] && $id)
        {
          piklist_user::multiple_roles($id, $object['user_role']);
        }

      break;
    }

    if ($belongs_to && $id)
    {
      self::relate($belongs_to, $id);
    }
    
    return isset($id) ? $id : false;
  }
  
  public static function relate($post_id, $has_post_id)
  {
    global $wpdb;
    
    $has_post_id = is_array($has_post_id) ? $has_post_id : array($has_post_id);
    
    foreach ($has_post_id as $has)
    {
      $found = $wpdb->get_col($wpdb->prepare('SELECT relate_id FROM ' . $wpdb->prefix . 'post_relationships WHERE post_id = %d AND has_post_id = %d', $post_id, $has));
      if (empty($found))
      {
        $wpdb->insert( 
          $wpdb->prefix . 'post_relationships'
          ,array(
            'post_id' => $post_id
            ,'has_post_id' => $has 
          ) 
          ,array( 
            '%d'
            ,'%d' 
          ) 
        );
      }
    }
  }
  
  public static function attributes_to_string($attributes = array(), $exclude = array())
  {
    $attribute_string = '';

    if (!is_array($attributes))
    {
      return $attribute_string;
    }
    
    foreach ($attributes as $key => $value)
    {
      if (isset($value) && ($value !== '') && !in_array($key, $exclude))
      {
        if (is_numeric($key))
        {
          $attribute_string .= $value . ' ';
        }
        else
        {
          $attribute_string .= $key . '="' . (is_array($value) ? implode(' ', $value) : $value) .'" '; 
        }
      }
    }

    return $attribute_string;
  }
}