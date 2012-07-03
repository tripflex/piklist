
<form 
  method="<?php echo $method; ?>" 
  action="<?php echo $_SERVER['REQUEST_URI']; ?>" 
  enctype="multipart/form-data" 
  <?php echo piklist_form::attributes_to_string($attributes); ?>
>

  <?php
  
    piklist('field', array(
      'type' => 'hidden'
      ,'field' => 'nonce'
      ,'value' => $nonce
    ));
  
    if (!empty($ids))
    {
      foreach ($ids as $type => $id)
      {
        piklist('field', array(
          'type' => 'hidden'
          ,'scope' => $type
          ,'field' => (in_array($type, array('comment')) ? $type . '_' : '') . (in_array($type, array('taxonomy')) ? 'id' : 'ID')
          ,'value' => $id
        ));
      }
    }
    
    foreach (array('post', 'comment', 'taxonomy', 'user') as $type)
    {
      $field = (in_array($type, array('comment')) ? $type . '_' : '') . (in_array($type, array('taxonomy')) ? 'id' : 'ID');
      if (isset($_REQUEST[$field]))
      {
        piklist_form::$save_ids[$type] = $_REQUEST[$field];
      } 
    }
    
    // NOTE: comments, terms, user
    // NOTE: Do we need the field?
    if (isset($_REQUEST['ID']))
    {
      piklist_form::$save_ids['post'] = $_REQUEST['ID'];
      
      piklist('field', array(
        'type' => 'hidden'
        ,'scope' => 'post'
        ,'field' => 'ID'
        ,'value' => $_REQUEST['ID']
      ));
    }
     
  ?>
  
  <?php piklist::render($form); ?>
  
  <?php piklist_form::save_fields(); ?>  
  
</form>