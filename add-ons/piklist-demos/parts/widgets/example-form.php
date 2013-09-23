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