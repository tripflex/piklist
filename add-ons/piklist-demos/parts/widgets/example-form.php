<?php
/*
Width: 720
*/
?>

<ul class="wp-tab-bar">
  <li class="wp-tab-active"><a href="#"><?php _e('Basic'); ?></a></li>
  <li><a href="#"><?php _e('Large Text'); ?></a></li>
  <li><a href="#"><?php _e('Selects'); ?></a></li>
  <li><a href="#"><?php _e('Advanced'); ?></a></li>
  <li><a href="#"><?php _e('Conditionals'); ?></a></li>
  <li><a href="#"><?php _e('Subscription'); ?></a></li>
</ul>

<div class="wp-tab-panel">
  
  <?php
    piklist('field', array(
      'type' => 'text'
      ,'field' => 'demo_text_small'
      ,'label' => __('Text ~ small-text')
      ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'value' => 'Lorem'
      ,'attributes' => array(
        'class' => 'small-text'
      )
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'text_required'
      ,'label' => 'Text Required'
      ,'description' => "required' => true"
      ,'attributes' => array(
        'class' => 'small-text'
      )
      ,'required' => true
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'text_null'
      ,'label' => 'Text Null'
      ,'value' => 'null'
      ,'description' => "required' => true"
      ,'attributes' => array(
        'class' => 'small-text'
      )
      ,'required' => true
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'text_false'
      ,'label' => 'Text False'
      ,'value' => 'false'
      ,'description' => "required' => true"
      ,'attributes' => array(
        'class' => 'small-text'
      )
      ,'required' => true
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'demo_text'
      ,'label' => __('Text')
      ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'value' => 'Lorem'
      ,'attributes' => array(
        'class' => 'text'
      )
    ));
  
    piklist('field', array(
      'type' => 'text'
      ,'field' => 'demo_text_large'
      ,'label' => __('Text ~ large-text')
      ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'value' => 'Lorem'
      ,'attributes' => array(
        'class' => 'large-text'
      )
    ));
  ?>

</div>

<div class="wp-tab-panel">

  <?php

    piklist('field', array(
      'type' => 'textarea'
      ,'field' => 'demo_textarea_large'
      ,'label' => __('Textarea ~ large-text code')
      ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'value' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'attributes' => array(
        'rows' => 10
        ,'cols' => 50
        ,'class' => 'large-text code'
      )
    ));

  ?>

</div>

<div class="wp-tab-panel">

  <?php

    piklist('field', array(
      'type' => 'select'
      ,'field' => 'demo_select'
      ,'label' => __('Select')
      ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'value' => 'third'
      ,'choices' => array(
        'first' => 'First Choice'
        ,'second' => 'Second Choice'
        ,'third' => 'Third Choice'
      )
      ,'attributes' => array(
        'class' => 'clear-left'
      )
    ));

    piklist('field', array(
      'type' => 'radio'
      ,'field' => 'demo_radio'
      ,'label' => __('Radio')
      ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'value' => 'third'
      ,'choices' => array(
        'first' => 'First Choice'
        ,'second' => 'Second Choice with a nested [field=radio_text_small] input.'
        ,'third' => 'Third Choice'
      )
      ,'fields' => array(
        array(
          'type' => 'text'
          ,'field' => 'radio_text_small'
          ,'value' => '12345'
          ,'embed' => true
          ,'attributes' => array(
            'class' => 'small-text widefat'
          )
        )
      )
    ));
  
    piklist('field', array(
      'type' => 'checkbox'
      ,'field' => 'demo_checkbox'
      ,'label' => __('Checkbox')
      ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'value' => 'second'
      ,'choices' => array(
        'first' => 'First Choice'
        ,'second' => 'Second Choice'
        ,'third' => 'Third Choice with a nested [field=checkbox_select] input.'
      )
      ,'fields' => array(
        array(
          'type' => 'select'
          ,'field' => 'checkbox_select'
          ,'value' => 'third'
          ,'embed' => true
          ,'choices' => array(
            'first' => 'First Choice'
            ,'second' => 'Second Choice'
            ,'third' => 'Third Choice'
          )
        )
      )
    ));
    
  ?>

</div>

<div class="wp-tab-panel">

  <?php
    
    piklist('field', array(
      'type' => 'file'
      ,'field' => 'upload_media'
      ,'label' => 'File'
      ,'options' => array(
        'title' => 'Add Media'
        ,'button' => 'Add Media'
      )
    ));

    piklist('field', array(
      'type' => 'colorpicker'
      ,'field' => 'demo_color'
      ,'label' => __('Color Picker')
      ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'attributes' => array(
        'class' => 'clear-left'
      )
    ));
  
    piklist('field', array(
      'type' => 'datepicker'
      ,'field' => 'demo_date'
      ,'label' => __('Date')
      ,'description' => __('Choose a date')
      ,'attributes' => array(
        'class' => 'clear-left'
      )
      ,'options' => array(
        'dateFormat' => 'M d, yy'
      )
      ,'value' => date('M d, Y', time() + 604800)
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'demo_text_add_more'
      ,'add_more' => true
      ,'label' => __('Add More')
      ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
      ,'value' => 'Lorem'
      ,'attributes' => array(
        'class' => 'text'
      )
    ));

  ?>
  
</div>

<div class="wp-tab-panel">
  
  <?php
    
    piklist('field', array(
      'type' => 'select'
      ,'field' => 'show_hide_select'
      ,'label' => 'Select: toggle a field'
      ,'choices' => array(
        'show' => 'Show'
        ,'hide' => 'Hide'
      )
      ,'value' => 'hide'
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'show_hide_field_select'
      ,'label' => 'Show/Hide Field 1' 
      ,'description' => 'This field is toggled by the Select field above'
      ,'conditions' => array(
        array(
          'field' => 'show_hide_select'
          ,'value' => 'show'
        )
      )
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'show_hide_field_select_2'
      ,'label' => 'Show/Hide Field 2'
      ,'description' => 'This field is toggled by the Select field above'
      ,'conditions' => array(
        array(
          'field' => 'show_hide_select'
          ,'value' => 'show'
        )
      )
    ));

    piklist('field', array(
      'type' => 'radio'
      ,'field' => 'show_hide'
      ,'label' => 'Radio: toggle a field'
      ,'choices' => array(
        'show' => 'Show'
        ,'hide' => 'Hide'
      )
      ,'value' => 'hide'
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'show_hide_field'
      ,'label' => 'Show/Hide Field'
      ,'description' => 'This field is toggled by the Radio field above'
      ,'conditions' => array(
        array(
          'field' => 'show_hide'
          ,'value' => 'show'
        )
      )
    ));

    piklist('field', array(
      'type' => 'checkbox'
      ,'field' => 'show_hide_checkbox'
      ,'label' => 'Checkbox: toggle a field'
      ,'choices' => array(
        'show' => 'Show'
      )
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'show_hide_field_checkbox'
      ,'label' => 'Show/Hide Field'
      ,'description' => 'This field is toggled by the Checkbox field above'
      ,'conditions' => array(
        array(
          'field' => 'show_hide_checkbox'
          ,'value' => 'show'
        )
      )
    ));
  
    piklist('field', array(
      'type' => 'radio'
      ,'field' => 'change'
      ,'label' => 'Update a field'
      ,'choices' => array(
        'hello-world' => 'Hello World'
        ,'clear' => 'Clear'
      )
      ,'value' => 'hello-world'
      ,'conditions' => array(
        array(
          'field' => 'update_field'
          ,'value' => 'hello-world' 
          ,'update' => 'Hello World!' 
          ,'type' => 'update'
        )
        ,array(
          'field' => 'update_field'
          ,'value' => 'clear' 
          ,'update' => '' 
          ,'type' => 'update'
        )
      )
    ));

    piklist('field', array(
      'type' => 'text'
      ,'field' => 'update_field'
      ,'value' => 'Hello World!' 
      ,'label' => 'Update This Field'
      ,'description' => 'This field is updated by the field above'
    ));
  
    piklist('field', array(
      'type' => 'checkbox'
      ,'field' => 'enable_field_below'
      ,'label' => 'Auto Enable Example'
      ,'description' => 'This field is updated by using the field below'
      ,'choices' => array(
        'enable' => 'Enable'
      )
      ,'conditions' => array(
        array(
          'field' => 'enable_description'
          ,'value' => 'enable' 
          ,'update' => 'enable' 
          ,'type' => 'update'
        )
      )
    ));
  
    piklist('field', array(
      'type' => 'textarea'
      ,'field' => 'enable_description'
      ,'label' => 'Description'
      ,'attributes' => array(
        'rows' => 10
        ,'cols' => 50
        ,'class' => 'large-text code'
      )
    ));
  
  ?>
  
</div>

<div class="wp-tab-panel">

  <?php
    
    piklist('field', array(
      'type' => 'select'
      ,'field' => 'mode'
      ,'label' => 'Mode'
      ,'choices' => array(
        'simple' => 'Simple'
        ,'challenging' => 'Challenging'
        ,'difficult' => 'Difficult'
      )
    ));

    piklist('field', array(
      'type' => 'checkbox'
      ,'field' => 'already'
      ,'label' => 'Already Visited'
      ,'choices' => array(
         'yes' => 'Yes'
      )
      ,'conditions' => array(
        array(
          'field' => 'mode'
          ,'value' => 'simple'
          ,'exclude' => true
        )
      )
    ));

    piklist('field', array(
      'type' => 'select'
      ,'field' => 'subscribe'
      ,'label' => 'Subscribe'
      ,'choices' => array(
         '' => 'Don\'t subscribe'
         ,'yes' => 'Subscribe to the service'
      )
      ,'conditions' => array(
        array(
          'field' => 'mode'
          ,'value' => array( 
            'challenging' 
            ,'difficult'
          )
        )
      )
    ));

    piklist('field', array(
      'type' => 'textarea'
      ,'field' => 'message'
      ,'label' => 'Message'
      ,'columns' => 12
      ,'conditions' => array(
        array(
          'field' => 'subscribe'
          ,'value' => 'yes'
        )
        ,array(
          'field' => 'mode'
          ,'value' => 'difficult'
        )
      )
    ));

    piklist('field', array(
      'type' => 'textarea'
      ,'field' => 'description'
      ,'label' => 'Description'
      ,'columns' => 12
      ,'conditions' => array(
        'relation' => 'or'
        ,array(
          'field' => 'mode'
          ,'value' => 'simple'
        )
        ,array(
          'field' => 'subscribe'
          ,'value' => 'yes'
        )
      )
    ));

    piklist('field', array(
      'type' => 'html'
      ,'field' => '_example_hint'
      ,'label' => 'Hint'
      ,'value' => 'Etiam porta sem malesuada magna mollis euismod. Fusce dapibus tellus ac cursus commodo tortor mauris condimentum nibh ut fermentum massa justo sit amet risus.'
      ,'columns' => 12
      ,'conditions' => array(
        'relation' => 'or'
        ,array(
          'field' => 'mode'
          ,'value' => 'simple'
        )
        ,array(
          'field' => 'subscribe'
          ,'value' => 'yes'
        )
      )
    ));

    piklist('field', array(
      'type' => 'group'
      ,'field' => 'values'
      ,'label' => 'Values'
      ,'columns' => 12
      ,'add_more' => TRUE
      ,'fields' => array(
        array(
          'type' => 'text'
          ,'field' => 'first_name'
          ,'label' => 'First Name'
          ,'columns' => 12
        )
        ,array(
          'type' => 'text'
          ,'field' => 'last_name'
          ,'label' => 'Last Name'
          ,'columns' => 12
        )
      )
      ,'conditions' => array(
        array(
          'field' => 'mode'
          ,'value' => 'difficult'
        )
      )
    ));
    
  ?>

</div>