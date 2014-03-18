
<?php if (!empty($widgets)): ?>
  
  <?php
    $choices = array(
      '' => __('Select a Widget', 'piklist')
    );

    foreach ($widgets as $w)
    {
      $choices[$widget_name . '--' . $w['add_on'] . '--' . $w['name']] = $w['data']['title'];
    }

    piklist('field', array(
      'type' => 'select'
      ,'field' => $widget_name
      ,'label' => __('Select a Widget','piklist')
      ,'value' => isset($instance[$name]) ? $instance[$name] : null
      ,'attributes' => array(
        'class' => array(
          'widefat'
          ,$class_name . '-widget-select'
        )
        ,'onchange' => array(
          'piklist_admin.widgets(this);'
        )
      )
      ,'position' => 'wrap'
      ,'choices' => $choices
    ));
  ?>

  <div class="<?php echo $class_name; ?>-forms">
    
    <?php 
      foreach ($widgets as $w): 
        $_widgets = isset($instance[$widget_name]) ? maybe_unserialize($instance[$widget_name]) : null;
        $_widget_name = is_array($_widgets) ? current($_widgets) : null;
    ?>
      
      <div class="hide-all <?php echo !empty($w['form_data']['width']) ? 'piklist-widget-width-' . $w['form_data']['width'] : ''; ?> <?php echo !empty($w['form_data']['height']) ? 'piklist-widget-height-' . $w['form_data']['height'] : ''; ?> <?php echo $class_name; ?>-form <?php echo $class_name; ?>-form-<?php echo $w['add_on'] . '--' . $w['name']; ?> <?php echo $_widget_name == $widget_name . '--' . $w['add_on'] . '--' . $w['name'] ? $class_name . '-form-selected' : ''; ?> ">
        
        <?php do_action('admin_notices'); ?>
        
        <?php if (!empty($w['data']['description'])): ?>
      
          <p>
            <em><?php echo $w['data']['description']; ?></em>
          </p>
      
        <?php endif; ?>

        <?php if ($w['form']) piklist($w['form']); ?>

      </div>

    <?php endforeach; ?>

    <?php piklist_form::save_fields(); ?>

  </div>

<?php else: ?>
  
  <p>
    <em><?php __('There are currently no Widgets available.', 'piklist'); ?></em>
  </p>
  
  <h4><?php _e('Learn to make Widgets', 'piklist'); ?></h4>
  
  <p>
    <?php _e('Check out the documentation for how to easily build your own custom widgets!', 'piklist')?>
  </p>  
  
<?php endif; ?>
