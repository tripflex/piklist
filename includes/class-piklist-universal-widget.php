<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Universal_Widget extends WP_Widget 
{
  public $widgets = array();

  public $instance = array();

  public $widget_core_name = 'piklist_universal_widget';
  
  public $widget_name = '';

  public $widgets_path = '';
  
  public function PikList_Universal_Widget($name, $title, $description, $path = array(), $control_options = array()) 
  {
    $this->widget_name = $name;
    $this->widgets_path = $path;
    
    $this->WP_Widget(
      ucwords(piklist::dashes($this->widget_name))
      ,__($title)
      ,array(
        'classname' => piklist::dashes($this->widget_core_name)
        ,'description' => __($description)
      )
      ,$control_options
    );
    
    add_action('wp_ajax_' . $name, array(&$this, 'ajax'));
  }
  
  public function form($instance) 
  {
    $this->register_widgets();
    
    $this->instance = $instance;

    if (isset($this->instance['widget']))
    {
      $widget = maybe_unserialize($this->instance['widget']);
      $widget = is_array($widget) ? current($widget) : null;      
    }
    
    piklist_widget::$current_widget = $this->widget_name;
    
    piklist::render('shared/widget-select', array(
      'instance' => $instance
      ,'widgets' => $this->widgets
      ,'name' => $this->widget_core_name
      ,'widget_name' => $this->widget_name
      ,'class_name' => piklist::dashes($this->widget_core_name)
      ,'widget' => isset($widget) ? $widget : null 
    ));
    
    return $instance;
  }
  
  public function ajax()
  {
    global $wp_widget_factory;
    
    $widget = isset($_REQUEST['widget']) ? $_REQUEST['widget'] : null;
    
    if ($widget)
    {
      $this->register_widgets();
      
      piklist_widget::$current_widget = $this->widget_name;
      
      if (isset($_REQUEST['number']))
      {
        $instances = get_option('widget_' . piklist::dashes($this->widget_name));
      
        piklist_widget::widget()->_set($_REQUEST['number']);
        piklist_widget::widget()->instance = $instances[$_REQUEST['number']];
      }

      if (isset($this->widgets[$widget]))
      {
        ob_start();
        
          do_action('piklist_widget_notices');
        
          piklist::render($this->widgets[$widget]['form'], null);
          
          piklist_form::save_fields();
        
        $output = ob_get_contents();
  
        ob_end_clean();
            
        echo json_encode(array(
          'form' => $output
          ,'widget' => $this->widgets[$widget]
        ));
      }
    }
    
    die;
  }

  public function update($new_instance, $old_instance)
  {
    if (piklist_validate::check())
    { 
      $instance = array();
    
      foreach ($new_instance as $key => $value)
      {
        if (!empty($value))
        {
          $instance[$key] = is_array($value) ? maybe_serialize($value) : stripslashes($value);
        }
      }
    
      return $instance;
    }
    
    return $old_instance;
  }

  public function widget($arguments, $instance) 
  {
    // NOTE: Add filter to block the display for perms, etc
    extract($arguments);

    $instance = piklist::object_value($instance);
       
    $options = explode('--', $instance[$this->widget_name]);
    $this->widgets[$options[0]]['instance'] = $instance;

    unset($instance[$this->widget_name]);

    piklist_widget::$current_widget = $this->widget_name;
    
    piklist::render(piklist::$paths[$options[1]] . '/parts/widgets/' . $options[2], array(
      'instance' => $instance
      ,'settings' => $instance // NOTE: So beginners have a more understandable name to store variables from the widget
      ,'before_widget' => $before_widget
      ,'after_widget' => $after_widget
      ,'before_title' => $before_title
      ,'after_title' => $after_title
    ));
  }
  
  public function register_widgets()
  {
    piklist::process_views('widgets', array(&$this, 'register_widgets_callback'), $this->widgets_path);
  }

  public function register_widgets_callback($arguments)
  {
    extract($arguments);
    
    if (!strstr($part, '-form.php'))
    {
      $path .= '/parts/' . $folder . '/';
      $name = piklist::dashes(strtolower(str_replace('.php', '', $part)));
      $form = file_exists($path . $name . '-form.php') ? $path . $name . '-form.php' : false;
      
      $this->widgets[$name] = array(
        'name' => $name
        ,'add_on' => $add_on
        ,'path' => $path . $name
        ,'form' => $form
        ,'form_data' => !$form ? false : get_file_data($form, array(
          'height' => 'Height'
          ,'width' => 'Width'
        ))
        ,'data' => get_file_data($path . $part, array(
          'title' => 'Title'
          ,'description' => 'Description'
          ,'tags' => 'Tags'
        ))
      );
    }
  }
}