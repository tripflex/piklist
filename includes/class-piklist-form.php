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
                  <p id="%1$s" class="%2$s">
                    [field_label]
                    [field]
                    [field_description_wrapper]
                      <small>[field_description]</small>
                    [/field_description_wrapper]
                  </p>
                  [/field_wrapper]'
    ,'post_meta' => '<table class="form-table">
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
    ,'theme' => '<table class="form-table">
                   [field_wrapper]
                   <tr id="%1$s" class="%2$s">
                     <td scope="row" class="left" width="200">
                       [field_label]
                     </td>
                     <td>
                       [field]
                       [field_description_wrapper]
                         <p><small>[field_description]</small></p>
                       [/field_description_wrapper]
                     </td>
                   </tr>
                   [/field_wrapper]
                 </table>'
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
    
    self::save_fields_actions();
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
  
  public static function get_field_id($field, $scope, $index = false)
  {
    if (self::is_widget() && ($scope != 'piklist' && $field != 'fields_id'))
    {
      $id = piklist_widget::widget()->get_field_id($field);
    }
    else
    {
      $id = ($scope ? $scope . '_' : null) . str_replace('][', '_', $field) . (is_numeric($index) ? '_' . $index : null);
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
  
  public static function get_field_name($field, $scope, $index = false)
  {
    if (self::is_widget() && ($scope != 'piklist' && $field != 'fields_id'))
    {
      $name = piklist_widget::widget()->get_field_name($field). (is_numeric($index) ? '[]' : '');
    }
    else
    {
      $name = ($scope ? $scope . '[' : null) . $field . ($scope ? ']' : null) . (is_numeric($index) ? '[]' : null);
    }
    
    self::$fields_rendered[$scope][$field]['name'] = $name;
    
    return $name;
  }
  
  public static function get_field_value($scope, $field, $type = 'option', $id = false, $unique = false)
  {
    $key = isset($field['save_as']) ? $field['save_as'] : $field['field'];
    
    $saved = false;
    
    if (!$id)
    {
      if (isset($_REQUEST[$key]))
      {
        $saved = $_REQUEST[$key];
      }
      else if (isset($_REQUEST[$type][$key]))
      {
        $saved = $_REQUEST[$type][$key];
      }
    }
    
    if (!$saved)
    {
      switch ($type)
      {
        case 'option':
      
          $saved = get_option($scope);

        break;
      
        case 'taxonomy':
      
          if ($id)
          {
            $saved = piklist(wp_get_post_terms($id, $key), 'name');
            $key = false;
          }
        
        break;
            
        case 'post_meta':
        case 'user_meta': 
      
          if ($id)
          {
            $meta_key = $key ? $key : $scope;
            $saved = $type == 'user' ? get_user_meta($id, $meta_key) : get_post_meta($id, $meta_key, $unique);
            $saved = count($saved) == 1 && empty($saved[0]) ? false : $saved;
          }
        
        break;
      }
    }

    if (is_array($saved) && !empty($saved) && $key)
    {
      $saved = isset($saved[$key]) ? $saved[$key] : (isset($meta_key) && $key == $meta_key ? $saved : false);
    }
    else if (empty($saved))
    {
      $saved = false;
    }

    return $saved ? $saved : $field['value'];
  }

  public static function get_field_wrapper_id($field)
  {
    $index = null;
    
    do {
      
      $id = 'field_' . $field['field'] . ($index === null ? '' : '_' . $index);
      
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
    else if (self::is_widget())
    {
      $wrapper = 'widget';
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

          $value = $choices[$value];

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
    }
    
    // Set Defaults
    array_push(self::$fields_defaults, $field);
    
    // Manage Classes
    $field['attributes']['class'] = !is_array($field['attributes']['class']) ? explode(' ', $field['attributes']['class']) : $field['attributes']['class'];
    array_push($field['attributes']['class'], piklist_form::get_field_id($field['field'], $field['scope']));
    
    // Set Wrapper
    $wrapper = array(
      'id' => self::get_field_wrapper_id($field)
      ,'class' => array(
        'piklist-field-wrapper'
      )
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
      global $post;
      
      switch ($field['scope'])
      {
        case 'post_meta':
        case 'taxonomy':
          
          $id = isset(self::$save_ids['post']) ? self::$save_ids['post'] : (is_admin() ? $post->ID : false);
          $field['value'] = self::get_field_value($field['scope'], $field, $field['scope'], $id, false);
          
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
        $condition['id'] = piklist_form::get_field_id($condition['field'], $condition['scope']);
        array_push($wrapper['class'], 'piklist-field-' . (isset($condition['type']) && $condition['type'] ? $condition['type'] : 'condition'));
      }
    }
  
    // Set the field template        
    $field['template'] = $field['type'] == 'hidden' || $field['embed'] ? 'field' : $field['template'];
    $field['wrapper'] = sprintf(self::$templates[$field['template']], $wrapper['id'], implode(' ', $wrapper['class']));
    
    $field = apply_filters('piklist_pre_render_field', $field);
    
    // Render the field
    self::$field_rendering = $field;
    
      self::$fields_rendered[$field['scope']][$field['field']] = $field;      
      
      $field_to_render = self::template_tag_fetch('field_wrapper', $field['wrapper']);

      $rendered_field = do_shortcode($field_to_render);
      
      
      // NOTE: Improve
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
    // NOTE: As of now this works with one form on a page generated by piklist, we need to hook it into the closing form tag on 
    //        front-end forms so we can do it per form instance
    if (!empty(self::$fields_rendered))
    {
      $fields_id = md5(serialize(self::$fields_defaults));
      
      if (current_user_can('manage_options'))
      {
        delete_transient('pik_' . $fields_id);
      }
      
      if (false === ($fields = get_transient('pik_' . $fields_id))) 
      {
        set_transient('pik_' . $fields_id, self::$fields_rendered, 60 * 60 * 24);
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
    // NOTE: Cover options-*.php pages. The best way may be to add a hidden settings field automatically as the last setting from piklist?
    $actions = array(
      'dbx_post_sidebar'
      ,'show_user_profile'
      ,'edit_user_profile'
      ,'piklist_settings_form'
    );
    foreach ($actions as $action) 
    {
      add_action($action, array('piklist_form', 'save_fields'), 101);
    }
    
    $taxonomies = get_taxonomies('', 'names'); 
    foreach ($taxonomies as $taxonomy) 
    {
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
      'for' => self::get_field_id($field['field'], $field['scope'])
      ,'class' => 'piklist' . ($field['child_field'] ? '-child' : '') . '-label'
    );
    
    $label_tag = !in_array($type, self::$field_list_types) ? 'label' : 'span';    
    
    return '<' . $label_tag . ($label_tag == 'span' ? ' class="piklist-label" ' : ' ') . self::attributes_to_string($attributes) . '>' . __($field['label']) . '</' . $label_tag . '>';
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
  
  public static function process_form()
  { 
    if (isset($_REQUEST['piklist']['nonce']) && wp_verify_nonce($_REQUEST['piklist']['nonce'], plugin_basename(__FILE__)))
    {      
      self::save();
      
      if (isset($_REQUEST['piklist']['redirect']))
      {
        wp_redirect($_REQUEST['piklist']['redirect'] . (!strstr($_REQUEST['piklist']['redirect'], '?ID=') ? '?ID=' . self::$save_ids['post'] : null));
      }
    }
  }
  
  public static function render_meta_box($box, $add_on)
  {
    global $wp_meta_boxes;
    
    $path = piklist::$paths[$add_on] . '/parts/meta-boxes/' . $box;
    
    $data = get_file_data($path . '.php', array(
              'name' => 'Title'
              ,'context' => 'Context'
              ,'description' => 'Description'
              ,'capability' => 'Capability'
              ,'priority' => 'Priority'
              ,'order' => 'Order'
              ,'type' => 'Type'
              ,'locked' => 'Locked'
              ,'status' => 'Status'
              ,'new' => 'New'
            ));
       
    $statuses = isset($data['status']) ? explode(',', $data['status']) : false;

    if (isset(self::$save_ids['post']))
    {
      $post = get_post(self::$save_ids['post']);
    }

    if (
      (!$data['capability'] || ($data['capability'] && current_user_can($data['capability'])))
      && (!$data['status'] || ($data['status'] && isset($post->post_status) && in_array($post->post_status, $statuses)))
      && (!$data['new'] || ($data['new'] == 'false' && $post->post_status != 'draft'))
    )
    {
      // NOTE: Better way to template this
      echo "<strong>{$data['name']}</strong>";

      piklist::render($path, $data);
    }
  }
  
  public static function save($ids = null)
  { 
    // NOTE: Meta Validation
    if (!isset($_REQUEST['piklist']['fields_id']))
    {
      return false;
    }

    self::$fields = get_transient('pik_' . $_REQUEST['piklist']['fields_id']);
    
    foreach (array('post', 'comment', 'user', 'taxonomy', 'post_meta', 'comment_meta', 'user_meta', 'taxonomy_meta') as $type)
    {
      if (isset($_REQUEST[$type]))
      {
        $data = $_REQUEST[$type];
      
        switch($type)
        {
          case 'post':
                    
            $ids['post'] = self::save_object('post', $data, isset($_REQUEST['post_ID']) ? $_REQUEST['post_ID'] : false);
          
          break;
        
          case 'post_meta':
            
            if (!isset($ids['post'])) 
            {
              break;
            }

            foreach ($data as $key => $value) 
            {
              if (!empty($value))
              {
                delete_post_meta($ids['post'], $key);
                
                if (is_array($value))
                {                  
                  if (self::$fields['post_meta'][$key]['serialize'])
                  {
                    add_post_meta($ids['post'], $key, $value, self::$fields['post_meta'][$key]['unique'] ? true : false);
                  }
                  else
                  {
                    foreach ($value as $meta)
                    {
                      if (!empty($meta))
                      {
                        if (is_array($meta) && $meta[0] && count($meta) == 1)
                        {
                          $meta = $meta[0];
                        }
                        
                        add_post_meta($ids['post'], $key, $meta);
                      }
                    }
                  }
                }
                else
                { 
                  add_post_meta($ids['post'], $key, $value, self::$fields['post_meta'][$key]['unique'] ? true : false);
                }
              }
            }
        
          break;
        
          case 'comment':
          
            $ids['comment'] = self::save_object('comment', $data);
          
          break;
        
          case 'comment_meta':
        
          break;
        
          case 'user':
        
            $ids['user'] = self::save_object('user', $data);
        
          break;
        
          case 'user_meta':
        
          break;
        
          case 'taxonomy':
        
            if (isset($ids['post']))
            {
              foreach ($data as $taxonomy => $terms)
              {
                $taxonomy = isset(self::$fields['taxonomy'][$taxonomy]['save_as']) ? self::$fields['taxonomy'][$taxonomy]['save_as'] : $taxonomy;
                
                $terms = is_array($terms) ? $terms : array($terms);
                foreach ($terms as &$term)
                {
                  $term = is_numeric($term) ? (int) $term : $term;
                }

                wp_set_object_terms($ids['post'], $terms, $taxonomy, isset(self::$fields['taxonomy'][$taxonomy]['save_as']));
              }
            }
        
          break;
        
          case 'taxonomy_meta':
        
          break;
        
          default: break;
        }
      }
    }
    
    self::$save_ids = $ids;
    
    if (isset($_REQUEST['post_relate']) && isset($_REQUEST['post_has']))
    {
      self::relate($ids['post'], $_REQUEST['post_has']);
    }
  }
  
  public static function save_object($type, $data, $belongs_to = false)
  {
    // NOTE: Remove once update action is handled
    // if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'editpost')
    // {
    //   return;
    // }

    $object = array();
    
    foreach (self::$core_scopes[$type] as $allowed)
    {
      if (isset($data[$allowed]) && !empty($data[$allowed]))
      {
        $object[$allowed] = sanitize_text_field($data[$allowed]);
      }
    }

    // NOTE: Handle Update vs Insert
    switch ($type)
    {
      case 'post':
                
        $id = $object['ID'] ? wp_update_post($object) : wp_insert_post($object);
        
        if (empty($object['post_title']) || !isset($object['post_title']))
        {
          piklist_cpt::default_post_title($id);
        }
        
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

    if ($belongs_to)
    {
      self::relate($belongs_to, $id);
    }
    
    return $id;
  }
  
  public static function relate($to, $belongs)
  {
    $found = $wpdb->get_col($wpdb->prepare('SELECT relate_id FROM ' . $wpdb->prefix . 'piklist_cpt_relate WHERE post_id = %d AND has_post_id = %d', $belongs, $to));

    if (empty($found))
    {
      $wpdb->insert( 
        $wpdb->prefix . 'piklist_cpt_relate'
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
  
  public static function attributes_to_string($attributes, $exclude = array())
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
