<?php

class PikList_Form
{
  private static $templates = array(
    'field'  => '[field]'
    ,'default' => '[field]
                   [field_description_wrapper]
                     <span class="description">[field_description]</span>
                   [/field_description_wrapper]'
    ,'widget' => '[field_wrapper]
                    <div id="%1$s" class="%2$s piklist-field-container">
                      <div class="piklist-label-container">
                        [field_label]
                      </div>
                      <div class="piklist-field">
                        [field]
                        [field_description_wrapper]
                          <span class="piklist-field-description description">[field_description]</span>
                        [/field_description_wrapper]
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
    ,'post_meta_classic' => '<table class="form-table">
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
                     [field_label]
                     <div class="piklist-field">
                       [field]
                       [field_description_wrapper]
                         <span class="piklist-field-description">[field_description]</span>
                       [/field_description_wrapper]
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
      ,'jabber'
      ,'aim'
      ,'yim'
    )
    ,'user_meta' => array()
    // NOTE: http://codex.wordpress.org/Function_Reference/wp_insert_term
    ,'taxonomy' => array(
      
    )
    // ,'taxonomy_meta' => array()
  );
  
  public static $save_ids = null;
  
  private static $field_alias = array(
    'datepicker' => 'text'
    ,'timepicker' => 'text'
    ,'colorpicker' => 'text'
    ,'submit' => 'button'
    ,'reset' => 'button'
  );
  
  private static $fields = null;
  
  private static $fields_defaults = array();
  
  private static $fields_rendered = array();
    
  private static $field_rendering = null;
  
  private static $field_wrapper_ids = array();
    
  private static $field_list_types = array(
    'checkbox'
    ,'radio'
    ,'add-ons'
  );
    
  public static function _construct()
  { 
    add_action('wp_loaded', array('piklist_form', 'wp_loaded'), 100);
    add_action('template_redirect', array('piklist_form', 'process_form'));
    add_action('admin_enqueue_scripts', array('piklist_form', 'scripts'));
    add_action('wp_enqueue_scripts', array('piklist_form', 'scripts'));
    add_action('post_edit_form_tag', array('piklist_form', 'add_enctype'));
    add_action('init', array('piklist_form', 'save_fields_actions'), 100);
  }
  
  public static function scripts()
  {
    global $wp_scripts;

    if (!is_object($wp_scripts))
    {
      return false;
    }
    
    $jquery_ui_core = $wp_scripts->query('jquery-ui-core');

    wp_register_style('jquery-ui-core', WP_CONTENT_URL . '/plugins/piklist/parts/css/jquery-ui/jquery-ui.smoothness.css', false, $jquery_ui_core->ver);
    wp_register_script('jquery-timepicker', WP_CONTENT_URL . '/plugins/piklist/parts/js/jquery.timePicker.min.js', array('jquery'), '0.1', true); 
    
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('jquery-timepicker');
    
    wp_enqueue_style('jquery-ui-core');
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
  
  public static function get_field_id($field, $scope, $index = false, $add_prefix = true)
  {
    if (!$field)
    {
      return false;
    }
    
    $prefix = $scope != 'piklist' && !is_admin() && $add_prefix ? piklist::$prefix : '';
    
    if (self::is_widget() && ($scope != 'piklist' && $field != 'fields_id'))
    {
      $id = $prefix . piklist_widget::widget()->get_field_id($field);
    }
    else
    {
      $id = $prefix . ($scope ? $scope . '_' : null) . str_replace('][', '_', $field) . (is_numeric($index) ? '_' . $index : null);
    }

    if ($index && $index > 0)
    {
      self::$fields_rendered[$scope][$field . '_' . $index] = self::$fields_rendered[$scope][$field];
      self::$fields_rendered[$scope][$field . '_' . $index]['id'] = $id;
    }
    else
    {
      self::$fields_rendered[$scope][$field]['id'] = $id;
    }
    
    return $id;
  }
  
  public static function get_field_name($field, $scope, $index = false, $add_prefix = true)
  {
    if (!$field)
    {
      return false;
    }
    
    $prefix = $scope != 'piklist' && !is_admin() && $add_prefix ? piklist::$prefix : '';
    
    if (self::is_widget() && ($scope != 'piklist' && $field != 'fields_id'))
    {
      $name = $prefix . piklist_widget::widget()->get_field_name($field). (is_numeric($index) ? '[]' : '');
    }
    else
    {
      $name = $prefix . ($scope ? $scope . (self::is_media() && isset($GLOBALS['piklist_attachment']) ? '_' . $GLOBALS['piklist_attachment']->ID: '') . '[' : null) . $field . ($scope ? ']' : null) . (is_numeric($index) ? '[]' : null);
    }
    
    self::$fields_rendered[$scope][$field]['name'] = $name;
    
    return $name;
  }
  
  public static function get_field_value($scope, $field, $type = 'option', $id = false, $unique = false)
  {
    global $wpdb;
    
    $key = isset($field['save_as']) ? $field['save_as'] : $field['field'];
    $saved = false;
    $prefix = is_admin() ? '' : piklist::$prefix;
    
    if (!$id)
    {
      if (isset($_REQUEST[$prefix . $key]))
      {
        $saved = $_REQUEST[$prefix . $key];
      }
      else if (isset($_REQUEST[$prefix . $type][$key]))
      {
        $saved = $_REQUEST[$prefix . $type][$key];
      }
    }
    
    if (!$saved)
    {
      switch ($type)
      {
        case 'option':
      
          $options = get_option($scope);
          
          return isset($options[$key]) ? $options[$key] : (isset($field['value']) ? $field['value'] : false);

        break;
      
        case 'taxonomy':
      
          if ($id)
          {
            $terms = piklist(wp_get_post_terms($id, $key), apply_filters('piklist_taxonomy_value_key', 'term_id', $key));

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
            $meta = get_metadata($meta_type, $id, $meta_key, $unique);
            
            return !empty($meta) ? (count($meta) == 1 && empty($meta[0]) ? false : $meta) : $field['value'];
          }
        
        break;
      }
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
    else if (self::is_post())
    {
      $wrapper = 'post_meta';
    }
    else if (self::is_media())
    {
      $wrapper = 'media_meta';
    }
    else if (self::is_widget())
    {
      $wrapper = 'widget';
    }
    else if ($type = self::is_term())
    {
      $wrapper = 'term_meta' . ($type == 'new' ? '_new' : '');
    }
    else if (self::is_user())
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
    
    return ($pagenow == 'widgets.php' || ($pagenow == 'admin-ajax.php' && $_REQUEST['action'] == 'save-widget'));
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
  
  public static function render_field($field, $return = false)
  {  
    $field = wp_parse_args($field, array(
      'field' => false
      ,'type' => 'text'                     // field type
      ,'label' => false
      ,'description' => false
      ,'scope' => null                      // how content is saved if you want it saved. post, post_meta, user, user_meta, comment, comment_meta (not required for Widget or Settings)
      ,'value' => null                      // default value
      ,'capability' => false                // one user role
      ,'add_more' => false                  // makes it an add more field
      ,'choices' => false                   // single array of values, or key => values
      ,'list' => true                       // wraps multiple in list
      ,'position' => false                  // start, end, wrap
      ,'serialize' => false                 // by default values stored as unique. To save as a serialized array, set to TRUE. Will work for any multiple select input.
      ,'template' => self::get_template()
      ,'wrapper' => false 
      ,'rows' => 1
      ,'columns' => null
      ,'embed' => false                     // internal
      ,'child_field' => false
      ,'label_position' => 'after'  
      ,'unique' => true                     // when editing a field, FALSE will add new data, TRUE will overwrite.
      ,'disable_label' => false             // remove label table cell (you would use for post_meta)
      ,'conditions' => false                // array of array of conditions
      ,'options' => false                   // tbd
      ,'on_post_status' => false 
      ,'on_comment_status' => false         // tbd
      ,'display' => false                   // show field value, not key (mostly internal)
      ,'required' => false                  // Is the field required?
      ,'index' => null                      // internal 
      ,'attributes' => array(               // html attributes
        'class' => array()
        ,'title' => false                     // title
        ,'alt' => false                       // alt 
        ,'tabindex' => false                  // tabindex
        ,'columns' => null
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
      ,'prefix' => true
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
      else if (self::is_media())
      {
        $field['scope'] = 'post_meta';
      }
      else if (self::is_term())
      {
        $field['scope'] = 'term_meta';
      }
      else if (self::is_user())
      {
        $field['scope'] = 'user_meta';
      }
    }
    
    // Set Defaults
    array_push(self::$fields_defaults, $field);
    
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
    
    // Set Wrapper
    $wrapper = array(
      'id' => self::get_field_wrapper_id($field)
      ,'class' => array()
    );
    
    // Set Columns
    if (is_numeric($field['columns']) && !$field['child_field'])
    {
      array_push($wrapper['class'], 'piklist-field-column-' . $field['columns']);
    }
    
    if (isset($field['attributes']['columns']) && is_numeric($field['attributes']['columns']))
    {
      array_push($field['attributes']['class'], 'piklist-field-column-' . $field['attributes']['columns']);
      unset($field['attributes']['columns']);
    }
    
    // Check Statuses
    $status_types = apply_filters('piklist_status_types', array(
      'post'
      // ,'comment' // NOTE: Not ready yet, need to get a list of comment status and how they are registered
    ));
    foreach ($status_types as $type)
    { 
      $status = $field['on_' . $type . '_status'];
      if (!empty($status))
      {
        $object = !empty(self::$save_ids) ? get_post(self::$save_ids[$type], ARRAY_A) : (array) $GLOBALS[$type];
        
        if ((is_admin() && isset($GLOBALS[$type])) || (!empty(self::$save_ids)))
        {
          $status_list = piklist_cpt::get_post_statuses($type, $object['post_type']);
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
        
        if (isset($status['hide']) && piklist::check_in($status['hide'], $object[$type . '_status'] ? $object[$type . '_status'] : array('draft')))
        {
          return false;
        }
        else if (isset($status['value']) && piklist::check_in($status['value'], $object[$type . '_status'] ? $object[$type . '_status'] : array('draft')))
        {
          $field['display'] = true;
        }   
      }
    }
        
    // Get field value
    if (self::is_widget())
    {
      $field['value'] = isset(piklist_widget::widget()->instance[$field['field']]) ? maybe_unserialize(piklist_widget::widget()->instance[$field['field']]) : $field['value'];
    }
    else
    {
      global $post, $tag_ID;
      
      switch ($field['scope'])
      {
        case 'post_meta':
        case 'taxonomy':
          
          if (isset($GLOBALS['piklist_attachment']))
          {
            $id = $GLOBALS['piklist_attachment']->ID;
          }
          else
          {
            $id = isset(self::$save_ids['post']) ? self::$save_ids['post'] : (is_admin() ? $post->ID : false);
          }
          
          $field['value'] = self::get_field_value($field['scope'], $field, $field['scope'], $id, false);
          
        break;

        case 'term_meta':
                
          $field['value'] = self::get_field_value($field['scope'], $field, $field['scope'], $tag_ID, false);
          
        break;
        
        case 'user_meta':
                
          $field['value'] = self::get_field_value($field['scope'], $field, $field['scope'], $_REQUEST['user_id'], false);
          
        break;

        default:

        break;
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
        $condition['id'] = piklist_form::get_field_id($condition['field'], $condition['scope'], false, isset($condition['prefix']) ? $condition['prefix'] : true);
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
      
      $field_key = $field['field'];
      if (!$field['field'])
      {
        $i = 0;
        while (isset(self::$fields_rendered[$field['scope']][$field['type'] . '_' . $i]))
        {
          $i++;
        }
        $field_key = ':' . $field['type'] . '_' . $i;
      }
      
      self::$fields_rendered[$field['scope']][$field_key] = $field;      
      
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
  
  public static function save_fields()
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
    else if ($wrapper == 'end')
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
        $dynamic = array();
        
        if (self::$field_rendering['add_more'] && !self::$field_rendering['display'])
        {
          array_push($dynamic, 'piklist-field-add-more');
        }

        if (is_numeric(self::$field_rendering['columns']) && self::$field_rendering['child_field'])
        {
          array_push($dynamic, 'piklist-field-column-' . self::$field_rendering['columns']);
        }
        
        if (self::$field_rendering['display'])
        {
          self::$field_rendering['value'] = is_array(self::$field_rendering['value']) && count(self::$field_rendering['value']) == 1 ? self::$field_rendering['value'][0] : self::$field_rendering['value'];
          self::$field_rendering['value'] = self::get_field_show_value(self::$field_rendering);
          
          $content = self::template_field('show', self::$field_rendering, $dynamic);
        }
        else if (in_array($type, self::$field_list_types) || (!is_array(self::$field_rendering['value']) || count(self::$field_rendering['value']) == 1))
        {
          self::$field_rendering['value'] = is_array(self::$field_rendering['value']) && !in_array($type, self::$field_list_types) ? self::$field_rendering['value'][0] : self::$field_rendering['value'];

          $content = self::template_field($type, self::$field_rendering, $dynamic);
        }
        else
        {      
          $values = is_array(self::$field_rendering['value']) ? self::$field_rendering['value'] : array(self::$field_rendering['value']);
          $values = array_values($values);
          $clone = self::$field_rendering;

          for ($i = 0; $i < count($values); $i++)
          {
            $clone['value'] = $values[$i];
            $clone['index'] = $i;

            $content .= self::template_field($type, $clone, $dynamic);
          }
        }
        
      break;
    }
    
    return $content;
  }
  
  public function template_label($type, $field)
  {
    if (empty($field['label']))
    {
      return '';
    }
  
    $attributes = array(
      'for' => self::get_field_id($field['field'], $field['scope'], false, $field['prefix'])
      ,'class' => 'piklist' . ($field['child_field'] ? '-child' : '') . '-label'
    );
    
    $label_tag = !in_array($type, self::$field_list_types) ? 'label' : 'span';    
    
    return '<' . $label_tag . ($label_tag == 'span' ? ' class="piklist-label" ' : ' ') . self::attributes_to_string($attributes) . '>' . __($field['label']) . ($field['required'] ? '<span class="piklist-required">*</span>' : '') . '</' . $label_tag . '>';
  }
 
  public static function template_field($type, $field, $dynamic = array())
  {
    $content = !empty($dynamic) ? '<span class="' . implode(' ', $dynamic) . '">' : '';
    
    if ($field['child_field'] && $field['label_position'] == 'before')
    {
      $content .= self::template_label($type, $field);
      $content .= piklist::render('fields/' . $type, $field, true);
    }
    else if ($field['child_field'] && $field['label_position'] == 'after')
    {
      $content .= piklist::render('fields/' . $type, $field, true);
      $content .= self::template_label($type, $field);
    }
    else
    {
      $content .= piklist::render('fields/' . $type, $field, true);
    }

    $content .= !empty($dynamic) ? '</span>' : '';
    
    return $content;
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
                    ,'capability' => 'Capability'
                  ));

          if (!$data['capability'] || ($data['capability'] && current_user_can($data['capability'])))
          {
            $data['nonce'] = wp_create_nonce('piklist/piklist.php');
            $data['form'] = $path . '/parts/forms/' . $form;
            $data['ids'] = self::$save_ids;
                        
            $content = piklist::render('fields/form', $data, true);
            
            return $content;
          }
        }
      }
    }
    
    return null;
  }
  
  public static function process_form($ids = null)
  { 
    if (isset($_REQUEST['piklist']['nonce']) && wp_verify_nonce($_REQUEST['piklist']['nonce'], plugin_basename(WP_PLUGIN_DIR . '/piklist/piklist.php')))
    {      
      self::save($ids);
      
      if (isset($_REQUEST['piklist']['redirect']))
      {
        wp_redirect($_REQUEST['piklist']['redirect'] . (!strstr($_REQUEST['piklist']['redirect'], '?ID=') ? '?ID=' . self::$save_ids['post'] : null));
      }
    }
  }
  
  public static function save($ids = null)
  { 
    global $wpdb;

    if (!isset($_REQUEST['piklist']['fields_id']) || isset($_REQUEST['piklist']['filter']))
    {
      return false;
    }
    
    self::$fields = get_transient(piklist::$prefix . $_REQUEST['piklist']['fields_id']);
    
    foreach (array('post', 'comment', 'user', 'taxonomy', 'post_meta', 'comment_meta', 'user_meta', 'term_meta') as $builtin)
    {
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
    
      $type = (is_admin() ? '' : piklist::$prefix) . $builtin;
      
      if (isset($_REQUEST[$type]) || $suffixed)
      {
        $data = $_REQUEST[$type . ($suffixed ? '_' . $suffixed : '')];
      
        switch ($builtin)
        {
          case 'post':
            
            self::save_object('post', $data, isset($_REQUEST['piklist']['post_id']) ? $_REQUEST['piklist']['post_id'] : false);
          
          break;
        
          case 'post_meta':
          case 'term_meta':
          case 'user_meta':
            
            $meta_type = substr($type, 0, strpos($type, '_'));
            $id = $suffixed ? $suffixed : $ids[$meta_type];

            if (empty($id)) 
            {
              break;
            }
            //          
            // piklist::pre($ids);
            // piklist::pre($meta_type);
            // piklist::pre($data);
            // piklist::pre($_REQUEST);
            // die;
            
            foreach ($data as $key => $value) 
            {
              delete_metadata($meta_type, $id, $key);
              
              if (is_array($value))
              {                  
                if (self::$fields[$type][$key]['serialize'])
                {
                  add_metadata($meta_type, $id, $key, $value, self::$fields[$type][$key]['unique']);
                }
                else
                {
                  foreach ($value as $meta)
                  {
                    if (!empty($meta))
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
              else
              { 
                add_metadata($meta_type, $id, $key, $value, self::$fields[$type][$key]['unique']);
              }
            }
            
            // TODO: Handle multi-step forms, i.e. status showing fields/values/nothing
            $unset_fields = array();
            $unsent_fields = self::fields_diff(self::$fields[$builtin], $data);
            
            foreach ($unsent_fields as $unsent_field)
            {
              if (strstr($unsent_field, ']['))
              {                
                $exploded_path = explode('][', $unsent_field);
                if (in_array($exploded_path[0], $unsent_fields))
                {
                  $tmp = &$unset_fields;
                  foreach($exploded_path as $key) 
                  {
                    $tmp = &$tmp[$key];
                  }
                  $tmp = null;
                  unset($tmp);
                }                
              }
              else 
              {
                $unset_fields[$unsent_field] = null;
              }
            }

            $ignore_fields = isset($_REQUEST['piklist']['ignore_' . $builtin]) ? $_REQUEST['piklist']['ignore_' . $builtin] : array();
            foreach ($unset_fields as $key => $value) 
            {
              if (!in_array($key, $ignore_fields))
              {
                delete_metadata($meta_type, $id, $key);
              
                if (is_array($value))
                {                  
                  if (self::$fields[$type][$key]['serialize'])
                  {
                    add_metadata($meta_type, $id, $key, $value, self::$fields[$type][$key]['unique'] ? true : false);
                  }
                  else
                  {
                    foreach ($value as $meta)
                    {
                      add_metadata($meta_type, $id, $key, $meta);
                    }
                  }
                }
                else
                { 
                  add_metadata($meta_type, $id, $key, $value, self::$fields[$type][$key]['unique'] ? true : false);
                }
              }
            }

          break;
        
          case 'comment':
          
            self::save_object('comment', $data);
          
          break;
        
          case 'comment_meta':
        
          break;
        
          case 'user':
        
            self::save_object('user', $data);
        
          break;
        
          case 'user_meta':
        
          break;
        
          case 'taxonomy':
        
            if (isset($ids['post']))
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
                wp_set_object_terms($ids['post'], $terms, $taxonomy, false);
              }
            }
        
          break;
        
          case 'taxonomy_meta':
        
          break;
        
          default: break;
        }
      }
      
      if (isset($_FILES[$type]))
      {
        switch($type)
        {
          case 'post':
            
            foreach ($_FILES[$type]['name'] as $fid => $file_name)
            {
              if ($_FILES[$type]['error'][$fid] === UPLOAD_ERR_OK)
              {
                $attach_id = media_handle_sideload(
                              array(
                                'name' => $file_name
                                ,'size' => $_FILES[$type]['size'][$fid]
                                ,'tmp_name' => $_FILES[$type]['tmp_name'][$fid]
                              )
                              ,isset($ids['post']) ? $ids['post'] : 0
                              ,null
                              ,isset($_REQUEST[$fid]) ? $_REQUEST[$fid] : null
                            );
                
                if (isset($_REQUEST[$fid]['post_status']) && !is_wp_error($attach_id))
                {
                  $wpdb->query($wpdb->prepare("UPDATE $wpdb->posts SET post_status = %s WHERE ID = %d", $_REQUEST[$fid]['post_status'], $attach_id));
                }
              }
            }
            
          break;
        
          case 'comment':
          
          break;
        
          case 'user':
        
          break;
        
          case 'taxonomy':
      
          break;
        
          default: 
          
            // NOTE: Uploads without scope
            
          break;
        }
      }
    }

    self::$save_ids = $ids;
    
    if (isset($_REQUEST['piklist']['relate']) && isset($_REQUEST['piklist']['post_id']))
    {
      self::relate($ids['post'], $_REQUEST['piklist']['post_id']);
    }
  }
  
  public static function fields_diff($rendered, $request)
  {
    foreach($rendered as $key => $field) 
    {
      if ($field['display'])
      {
        unset($rendered[$key]);
      }
    }
    
    return array_filter(array_diff(array_keys($rendered), array_keys($request)), create_function('$a', 'return substr($a, 0, 1) != ":";'));
  }
  
  public static function save_object($type, $data, $belongs_to = false)
  {
    $object = array();
    
    foreach (self::$core_scopes[$type] as $allowed)
    {
      if (isset($data[$allowed]) && !empty($data[$allowed]))
      {
        $object[$allowed] = sanitize_text_field($data[$allowed]);
      }
    }

    switch ($type)
    {
      case 'post':
                
        $id = $object['ID'] ? wp_update_post($object) : wp_insert_post($object);
        
      break;
      
      case 'comment':
        
        if (!empty($object['comment_content']))
        {
          $id = wp_insert_comment($object);
        }
        
      break;
      
      case 'user':
        
        $id = wp_insert_user($object);
        
      break;
    }

    if ($belongs_to && $id)
    {
      self::relate($belongs_to, $id);
    }
    
    return isset($id) ? $id : false;
  }
  
  public static function relate($to, $belongs)
  {
    global $wpdb;
    
    $found = $wpdb->get_col($wpdb->prepare('SELECT relate_id FROM ' . $wpdb->prefix . 'post_relationships WHERE post_id = %d AND has_post_id = %d', $belongs, $to));

    if (empty($found))
    {
      $wpdb->insert( 
        $wpdb->prefix . 'post_relationships'
        ,array(
          'post_id' => $belongs
          ,'has_post_id' => $to 
        ) 
        ,array( 
          '%d'
          ,'%d' 
        ) 
      );
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
      if ($value && !in_array($key, $exclude) && !is_numeric($key))
      {
        $attribute_string .= $key . '="' . (is_array($value) ? implode(' ', $value) : $value) .'" '; 
      }
    }

    return $attribute_string;
  }
}

?>
