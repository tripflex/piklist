
<form 
  method="get" 
  id="<?php echo $form_id; ?>"
>

  <?php $list_table->display(); ?>
  
  <?php if ($export): ?>
    
    <p class="alignright piklist-list-table-export">
      <a href="#TB_inline?height=700&width=840&inlineId=piklist-list-table-export-<?php echo $form_id; ?>" class="thickbox button piklist-list-table-export-button" title="Export"><?php _e('Export'); ?></a>
    </p>
  
  <?php endif; ?>
  
</form>

<div id="piklist-list-table-export-<?php echo $form_id; ?>" class="hidden">

  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="<?php echo $form_id; ?>_export">

    <div class="wrap">
    
      <h2><?php _e('Export Data'); ?></h2>
      
      <p>
        <?php _e('Select the fields you want to export and sort the into the order and headings desired.'); ?>
      </p>
      
      <?php
      
        piklist('field', array(
          'type' => 'text'
          ,'field' => 'save_download'
          ,'value' => 'Save Download as ...'
        ));
        
        piklist('field', array(
          'type' => 'select'
          ,'field' => 'restore_download'
          ,'label' => '- or -'
          ,'choices' => array(
            '-- Select Saved Export --'
            ,'Timing System Export'
            ,'Quicken Export'
          )
        ));
        
        piklist('field', array(
          'type' => 'button'
          ,'scope' => false
          ,'value' => __('Download') . '&darr;'
          ,'attributes' => array(
            'class' => 'button button-primary button-large piklist-list-table-export-submit'
            ,'rel' => $form_id . '_export'
          )
        ));
      ?>
      
      <div class="piklist-list-table-export-columns">

        <?php
        
          $keys = array_keys($list_table->items[0]);
          $values = array();
          foreach ($list_table->items as $item)
          {
            foreach ($item as $key => $value)
            {
              if (!is_array($values[$key]))
              {
                $values[$key] = array();
              }
            
              if (!in_array($value, $values[$key]))
              {
                array_push($values[$key], $value);
              }
            }
          }
          
          foreach ($keys as $key)
          {
            piklist('field', array(
              'type' => 'group'
              ,'field' => 'export'
              ,'add_more' => true
              ,'scope' => 'piklist_list_table'
              ,'fields' => array(
                array(
                  'type' => 'checkbox'
                  ,'field' => 'include'
                  ,'value' => 'true'
                  ,'choices' => array(
                    'true' => ''
                  )
                  ,'attributes' => array(
                    'style' => 'margin-right: 5px;'
                  )
                )
                ,array(
                  'type' => 'text'
                  ,'field' => 'header'
                  ,'value' => ucwords(str_replace('_', ' ', $key))
                  ,'attributes' => array(
                    'class' => 'regular-text'
                  )
                )
                ,array(
                  'type' => 'group'
                  ,'field' => 'options'
                  ,'add_more' => true
                  ,'fields' => array(
                    array(
                      'type' => 'select'
                      ,'field' => 'map'
                      ,'choices' => $values[$key]
                      ,'attributes' => array(
                        'style' => 'width: 120px;'
                      )
                    )
                    ,array(
                      'type' => 'text'
                      ,'field' => 'map_to'
                      ,'attributes' => array(
                        'class' => 'regular-text'
                      )
                    )
                    ,array(
                      'type' => 'select'
                      ,'field' => 'convert'
                      ,'column' => 4
                      ,'choices' => array(
                        '' => '-- Format Data --'
                        ,'m/d/Y' => 'mm/dd/yyyy'
                        ,'m-d-Y' => 'mm-dd-yyyy'
                        ,'m/d/Y H:i:s a' => 'mm/dd/yyyy hh:mm:ss a'
                        ,'m-d-Y H:i:s a' => 'mm-dd-yyyy hh:mm:ss a'
                        ,'m/d/Y g:i:s a' => 'mm/dd/yyyy h:mm:ss a'
                        ,'m-d-Y g:i:s a' => 'mm-dd-yyyy h:mm:ss a'
                        ,'ucwords' => 'Uppercase Words'
                        ,'strtoupper' => 'Uppercase'
                        ,'strtolower' => 'Lowercase'
                      )
                      ,'attributes' => array(
                        'style' => 'width: 120px;'
                      )
                    )                    
                  )
                )
              )
            ));
          }
        ?>
      
      </div>
    
      <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
    
      <?php
        piklist('field', array(
          'type' => 'hidden'
          ,'field' => 'piklist_list_table_export'
          ,'scope' => false
          ,'value' => $name
        ));
      
        piklist('field', array(
          'type' => 'button'
          ,'scope' => false
          ,'value' => __('Download') . '&darr;'
          ,'attributes' => array(
            'class' => 'button button-primary button-large piklist-list-table-export-submit'
            ,'rel' => $form_id . '_export'
          )
        ));
      ?>
  
    </div>
  
  </form>
  
</div>
