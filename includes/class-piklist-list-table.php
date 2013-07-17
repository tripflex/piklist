<?php

if (!defined('ABSPATH'))
{
  exit;
}

class Piklist_List_Table 
{
  public static function _construct()
  {   
    self::check_export('start'); 
  }
  
  public static function check_export($position = 'start', $list_table_name = false, $data = '')
  {
    if (isset($_REQUEST['piklist_list_table_export']) && !empty($_REQUEST['piklist_list_table_export']))
    {
      $name = $_REQUEST['piklist_list_table_export'][0];

      if ($position == 'start')
      {
        ob_start();
        
          $file = apply_filters('piklist_list_table_export_filename', 'export-' . piklist::dashes($name));
          
          header('Content-type: application/csv');
          header('Content-Disposition: attachment; filename=' . $file . '.csv');
          header('Pragma: no-cache');
          header('Expires: 0');
      }
      elseif ($position == 'end' && $name = $list_table_name)
      {
          ob_get_clean();
          
          if ($name = $list_table_name)
          {
            $headers = $columns = array();
            foreach ($_REQUEST['piklist_list_table'] as $key => $value)
            {
              if (isset($value[0]['include']))
              {
                array_push($headers, $value[0]['header'][0]);
                array_push($columns, $key);
              }
            }
            
            echo '"' . implode('","', $headers) . '"' . "\r\n";
            foreach ($data as $line)
            {
              $_line = array();
              foreach ($columns as $column)
              {
                array_push($_line, $line[$column]);
              }
              echo '"' . implode('","', $_line) . '"' . "\r\n";
            }
          }
          
        ob_end_flush();

        exit();
      }
    }
  }

  public static function render($arguments)
  {
    extract($arguments);
    
    $list_table = new Piklist_List_Table_Template($arguments);
    
    $list_table->prepare_items($arguments);
    
    piklist::render('shared/list-table', array(
      'list_table' => $list_table
      ,'name' => $name
      ,'export' => $export
      ,'form_id' => 'piklist_list_table_form_' . piklist::slug($name)
    ));
    
    self::check_export('end', $name, $data); 
  }
}

if (!class_exists('WP_List_Table'))
{
  require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Piklist_List_Table_Template extends WP_List_Table 
{
  public $key;

  public $name;
  
  public $actions = array();

  public $column;
  
  public $classes = array();
  
  public $columns = array();

  public $sortable_columns = array();
  
  public function __construct($arguments)
  {
    extract($arguments);
    
    // TODO: Require fields
    // TODO: Merge!!!
    $this->key = $key;
    $this->name = $name;
    $this->column = $column;
    $this->columns = $columns;
    $this->classes = isset($classes) ? $classes : array('widefat', 'fixed');
    $this->sortable_columns = $sortable_columns;
    $this->actions = isset($actions) ? $actions : $this->actions;
    
    parent::__construct(array(
      'singular' => piklist::singularize($this->name)
      ,'plural' => piklist::pluralize($this->name)
      ,'ajax' => $ajax
    ));
  }
  
  public function get_columns()
  {
    // TODO: Force it to be set
    // if (!isset($this->columns['cb']))
    // {
    //   $this->columns = array_merge(array('cb' => '<input type="checkbox" />'), $this->columns);
    // }
    
    return $this->columns;
  }
  
  public function get_sortable_columns() 
  {
    foreach ($this->columns as $column => $label)
    {
      if (!isset($this->sortable_columns[$column]) && $column != 'cb')
      {
        $this->sortable_columns[$column] = array($column, false);
      }
    }
    
    return $this->sortable_columns;
  }
  
  public function data_sort($a, $b)
  {
    $orderby = !empty($_REQUEST['orderby']) ? $_REQUEST['orderby'] : key($a); 
    $order = !empty($_REQUEST['order']) ? strtolower($_REQUEST['order']) : 'asc'; 
    $result = strcmp($a[$orderby], $b[$orderby]);

    return ($order === 'asc') ? $result : -$result;
  }
  
  public function column_cb($item)
  {
    return sprintf(
      '<input type="checkbox" name="%1$s[]" value="%2$s" />'
      ,$this->_args['singular']
      ,$item[$this->key]
    );
  }
  
  public function column_default($item, $column_name)
  {
    // EXAMPLE: How to use a filter to alter a cell...
    // if ($this->column == $column_name)
    // {
    //   $actions = array();
    //   foreach ($this->actions as $action => $label)
    //   {
    //     $actions[$action] = sprintf('<a href="?page=%s&action=%s&%s=%s">%s</a>', $_REQUEST['page'], $action, $this->name, $item[$this->key], $label);
    //   }
    // 
    //   return sprintf(
    //     '%1$s <span>(id:%2$s)</span>%3$s'
    //     ,$item[$this->column]
    //     ,$item[$this->key]
    //     ,$this->row_actions($actions)
    //   );
    // }
    // else
    // {
      // TODO: Add Filter to allow formatting changes or lookups like author ID to display name
      return isset($item[$column_name]) ? $item[$column_name] : null;
    // }
  }
  
  public function get_table_classes() 
  {
    array_push($this->classes, $this->_args['plural']);
    
    return $this->classes;
  }
  
  public function get_bulk_actions() 
  {
    // TODO: Add Filter to add more actions or adjust them
    return $this->actions;
  }
  
  public function process_bulk_action() 
  {
    // TODO: Add filter to process actions by table
    // switch ($this->current_action())
    // {
    //   case 'delete':
    //   
    //   break;
    // }
  }
  
  public function prepare_items($arguments) 
  {
    global $wpdb; 
    
    extract($arguments);

    $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns());
      
    $this->process_bulk_action();

    $data = is_object($data) || is_array($data) ? $data : $wpdb->get_results($data, ARRAY_A);
    usort($data, array($this, 'data_sort'));
            
    $current_page = $this->get_pagenum();

    $total_items = count($data);
    
    $this->items = array_slice($data, (($current_page - 1) * $per_page), $per_page);
    
    $this->set_pagination_args(array(
      'total_items' => $total_items
      ,'per_page' => $per_page
      ,'total_pages' => ceil($total_items / $per_page)
    ));
  }
}