<?php
/*
Plugin Name: Piklist
Plugin URI: http://piklist.com
Description: A Framework for Building Powerful Websites with WordPress.
Version: 0.7.2
Author: Piklist
Author URI: http://piklist.com
Text Domain: piklist
Domain Path: /languages
*/

  if (!defined('ABSPATH'))
  {
    exit;
  }
  
  if (!class_exists('Piklist'))
  {
    include_once 'includes/class-piklist.php';

    piklist::load();
  }
  
?>