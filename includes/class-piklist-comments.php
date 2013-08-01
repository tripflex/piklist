<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Comments
{
  private static $post_type_prefix;

  private static $post_meta_prefix;
  
  private static $objects = array(
    'taxonomies' => array()
    ,'users' => array()
  );
  
  public static function _construct()
  {    
    self::$post_type_prefix = piklist::$prefix . 'stub';
    self::$post_meta_prefix = piklist::$prefix . 'comments_';

    add_action('wp_footer', array('piklist_comments', 'print_scripts'));
    add_action('created_term', array('piklist_comments', 'create_term'), 10, 3);
    add_action('edited_term', array('piklist_comments', 'edit_term'), 10, 3);
    add_action('delete_term', array('piklist_comments', 'delete_term'), 10, 4);    
    add_action('init', array('piklist_comments', 'generate_rewrite_rules'), 101);

    add_filter('piklist_post_types', array('piklist_comments', 'post_types'));

    add_filter('get_comment_link', array('piklist_comments', 'get_comment_link'), 1, 3);
  }

  public static function print_scripts()
  {
    if (is_singular())
    {
      wp_enqueue_script('comment-reply');
    }
  }
  
  public static function generate_rewrite_rules()
  {    
    $taxonomies = get_taxonomies(array(
      'public' => true
    ), 'objects');

    foreach ($taxonomies as $taxonomy) 
    {
      if (property_exists($taxonomy, 'public') && property_exists($taxonomy, 'comments'))
      {
        add_rewrite_rule($taxonomy->rewrite['slug'] . '/([^/]+)/comment-page-([0-9]{1,})/?$', 'index.php?' . $taxonomy->query_var . '=$matches[1]&cpage=$matches[2]', 'top');

        array_push(self::$objects['taxonomies'], $taxonomy->name);
      }
    }
  }
  
  public static function get_comment_link($link, $comment, $arguments)
  {
    global $post;
      
    $taxonomies = get_taxonomies(array(
      'public' => true
    ), 'objects');

    foreach ($taxonomies as $taxonomy) 
    {
      if (get_post_type($post) == self::$post_type_prefix . $taxonomy->name) 
      {
        $meta = piklist('post_custom', $post->ID);
        $permalink = get_permalink($post->ID);
        
        // TODO: Users vs terms
        $term_link = get_term_link((int) $meta[self::$post_meta_prefix . 'term_id'], $meta[self::$post_meta_prefix . 'taxonomy']);
        
        return str_replace($permalink, $term_link, $link);
      }
    }
  
    return $link;
  }
  
  public static function comments_template($file = '/comments.php', $separate_comments = false)
  {
    $term = get_queried_object();
    
    if (isset($term->term_id))
    {
      global $id, $post, $withcomments;

      $withcomments = true;
      
      $_post = $post;

      // TODO: Users vs terms
      $post = self::get_term_post($term->term_id, $term->taxonomy, true);
     
      $_id = $id;
      $id = $post->ID;

      comments_template($file, $separate_comments);
    
      $post = $_post;
      $id = $_id;
    }
  }
  
  public static function create_term($term_id, $taxonomy_term_id, $taxonomy)
  {
    self::process_term($term_id, $taxonomy);
  }
  
  public static function edit_term($term_id, $taxonomy_term_id, $taxonomy)
  {
    self::process_term($term_id, $taxonomy);
  }
  
  public static function delete_term($term_id, $taxonomy_term_id, $taxonomy, $deleted_term)
  {
    if (in_array($taxonomy, self::$objects['taxonomies']))
    {
      $term = get_term_by('id', $term_id, $taxonomy);

      $exists = self::get_term_post($term_id, $taxonomy);
      
      if (!empty($exists))
      {
        wp_delete_post($exists->ID);
      }
    }
  }
  
  public static function process_term($term_id, $taxonomy, $return_post = false)
  {
    global $wp_taxonomies;
    
    // TODO: Users vs terms, profile update action for users?
    
    if (isset($wp_taxonomies[$taxonomy]->comments))
    {
      $term = get_term_by('id', $term_id, $taxonomy);
      
      $post = array(
        'post' => array(
          'post_title' => $term->name
          ,'post_name' => $term->slug
          ,'post_content' => $term->description
          ,'post_excerpt' => $term->description
          ,'post_status' => 'publish'
          ,'post_type' => self::$post_type_prefix . $taxonomy
        )
        ,'meta' => array(
          self::$post_meta_prefix . 'term_id' => $term_id
          ,self::$post_meta_prefix . 'taxonomy' => $taxonomy
        )
      );
      
      $exists = self::get_term_post($term_id, $taxonomy);
      
      if (!empty($exists))
      {
        $post['post']['ID'] = $exists->ID;
        $post_id = wp_update_post($post['post']);
      }
      else
      {
        $post_id = wp_insert_post($post['post']);
      }
      
      foreach ($post['meta'] as $meta_key => $meta_value)
      {
        // KM: in original plugin
        //delete_metadata('post', $post_id, $meta_key, $meta_value);
        update_post_meta($post_id, $meta_key, $meta_value);
      }
      
      if ($return_post)
      {
        return get_post($post_id);
      }
    }
  }
  
  public static function get_term_post($term_id, $taxonomy, $create = false)
  {

    $term_id = '1831';
    $taxonomy = 'bp-game';


    $posts = get_posts(array(
      'post_type' => self::$post_type_prefix . $taxonomy
      ,'post_status' => 'any'
      ,'meta_query' => array(
        array(
          'key' => self::$post_meta_prefix . 'term_id'
          ,'value' => $term_id
        )
      )
      ,'posts_per_page' => '1'
    ));
    
    if (!empty($posts))
    {
      return reset($posts);
    }
    else if ($create)
    {
      return self::process_term($term_id, $taxonomy, true);
    }

    return false;
  }
  
  public static function post_types($post_types)
  {
    $taxonomies = get_taxonomies(array(
      'public' => true
    ), 'objects');
    
    foreach ($taxonomies as $slug => $taxonomy)
    {
      if (property_exists($taxonomy, 'comments'))
      {
        $post_types[self::$post_type_prefix . $slug] = array(
          'label' => piklist('post_type_labels', $taxonomy->labels->name)
          ,'public' => false
          ,'has_archive' => true
          ,'query_var' => false
          ,'supports' => array(
            'title'
            ,'comments'
            ,'custom-fields'
            ,'trackbacks'
            ,'excerpt'
            ,'editor'
          )
        );
      }
    }
    
    return $post_types;
  }
}