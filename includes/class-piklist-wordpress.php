<?php

class PikList_WordPress
{
  public static function _construct()
  {    
    add_action('plugins_loaded', array('piklist_wordpress', 'php_notices_warnings'));
  }

  public static function php_notices_warnings()
  {
    // NOTE: http://core.trac.wordpress.org/ticket/18461
    remove_role('');
  }
}

?>