
<?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'): ?>
  
  <tr id="pik_text_class_small" class="form-field">
    <th scope="row" class="left">
      &nbsp;
    </th>
    <td>

      <h4><?php _e('The code that built these fields can be found here:','piklist'); ?></h4> 

      <code><?php echo str_replace(ABSPATH, '', $location); ?></code>
    
    </td>
  </tr>
  
<?php endif; ?>
