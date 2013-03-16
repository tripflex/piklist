<?php

class PikList_WordPress
{
  public static function _construct()
  {    
    add_action('plugins_loaded', array('piklist_wordpress', 'php_notices_warnings'));

    add_filter('get_meta_sql', array('piklist_wordpress', 'get_meta_sql'), 10, 6);
  }

  public static function php_notices_warnings()
  {
    // NOTE: http://core.trac.wordpress.org/ticket/18461
    remove_role('');
  }

  public function get_meta_sql($meta_query, $queries, $type, $primary_table, $primary_id_column, $context)
  {
    global $wpdb;
    
    $relation = 'AND';
    $where = array_filter(preg_split('/$\R?^/m', trim(substr($meta_query['where'], 6, strlen($meta_query['where']) - 8))));

    $meta_table = substr($primary_table, 0, strlen($primary_table) - 1) . 'meta';
    $meta_prefixes = array($meta_table . '.');
    for ($i = 1; $i < count($where); $i++)
    {
      array_push($meta_prefixes, 'mt' . $i . '.');
    }
    
    for ($i = 0; $i < count($where); $i++)
    {
      if ($i > 0)
      {
        if ($i == 1)
        {
          $relation = trim(substr($where[$i], 0, strpos($where[$i], '(')));
        }
      
        $where[$i] = substr($where[$i], strpos($where[$i], '('));
      }
      
      $where[$i] = str_replace($meta_prefixes, '', $where[$i]);
    }

    $post_ids = $wpdb->get_col("SELECT {$type}_id FROM {$meta_table} WHERE (" . implode("" . $relation . " ", $where) . ") GROUP BY {$type}_id");
    $where = " AND \n\t{$primary_table}.{$primary_id_column} IN (\n\t\t" . implode("\n\t\t,", $post_ids) . "\n\t) \n";
    
    $meta_query['join'] = '';
    $meta_query['where'] = $where;
    
    return $meta_query;
  }
}

?>