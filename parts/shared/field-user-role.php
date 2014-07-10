
<div class="hidden" id="role_stub">
  
  <?php
    piklist('field', array(
      'type' => 'hidden'
      ,'scope' => false
      ,'field' => 'role'
      ,'value' => $user_roles[0]
    ));
    
    piklist('field', array(
      'type' => 'checkbox'
      ,'scope' => false
      ,'field' => 'roles'
      ,'template' => 'field'
      ,'choices' => $roles
      ,'value' => $user_roles
    ));
  ?>

  <style type="text/css">
  
    select#role {
      display: none !important;
    }
  
  </style>

  <script type="text/javascript">

    (function($)
    {
      $(document).ready(function()
      {
        var role_field = 'select[name="role"]';
      
        if ($(role_field).length > 0)
        {
          var stub = $('div#role_stub').html();
        
          $(stub).insertAfter(role_field);
          $(role_field).parents('.form-field').removeClass('form-field');
          $(role_field + ', div#role_stub').remove();
        }
      });
    })(jQuery);

  </script>

</div>