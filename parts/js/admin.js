/* --------------------------------------------------------------------------------
  Updates or enhancements to Piklist Functionality
--------------------------------------------------------------------------------- */

  var piklist_admin;

  (function($)
  {
    $(document).ready(function()
    {
      piklist_admin.init();
    });
  
    piklist_admin = {
    
      init: function()
      {
        piklist_admin.meta_boxes();
        piklist_admin.widgets_init();
        piklist_admin.post_name();
        piklist_admin.post_submit_meta_box();
        piklist_admin.thickbox();
        piklist_admin.user_forms();
        piklist_admin.empty_elements();
        piklist_admin.list_tables();
      },
      
      empty_elements: function()
      {
        $('#post-body-content').each(function()
        {
          if ($.trim($(this).html()) == '')
          {
            $(this).html('');
          }
        });
      },

      user_forms: function()
      {
        if ($.browser.webkit) 
        {
          setTimeout(function() 
          {
            $('input:-webkit-autofill').each(function()
            {
              var name = $(this).attr('name');

              $(this).after(this.outerHTML).remove();
              $('input[name=' + name + ']').val('');
            });
          }, 250);
        }
      },

      thickbox: function()
      {
        $('.piklist-list-table-export-button').click(function() 
        {
          setTimeout(function() 
          {
            var TB_WIDTH = 870,
              TB_HEIGHT = 800; 

            $('#TB_window').css({
              marginLeft: '-' + parseInt((TB_WIDTH / 2), 10) + 'px'
              ,width: TB_WIDTH + 'px'
              ,height: TB_HEIGHT + 'px'
              ,marginTop: '-' + parseInt((TB_HEIGHT / 2), 10) + 'px'
            });
            
            $('#TB_ajaxContent').css({
              height: TB_HEIGHT - 45 + 'px'
            })
          }, 100)
        });
      },

      meta_boxes: function()
      {
        $('.piklist-meta-box-collapse:not(.piklist-meta-box-lock)').addClass('closed');
        
        $('.piklist-meta-box-lock')
          .addClass('stuffbox')
          .css('box-shadow', 'none')
          .find('div.handlediv')
            .removeClass('handlediv')
            .hide()
            .next('h3.hndle')
              .removeClass('hndle')
              .css('cursor', 'default');

        $('.piklist-meta-box-lock').show();
        
        $('.piklist-meta-box > .inside').each(function()
        {
          if ($(this).find(' > *:first-child').hasClass('piklist-field-container'))
          {
            $(this).css({
              'margin-top': '0'
            });
          }
        });
      },
      
      post_name: function()
      {
        var form = $('body.wp-admin.post-php form#post:first');
        
        if (form.length > 0)
        {
          var slug = form.find(':input#post_name');
          
          if (slug.length <= 0)
          {
            form.append($('<input type="hidden" name="post_name" id="post_name">'));
          }
        }
      },
      
      post_submit_meta_box: function()
      {
        $('.save-post-status', '#post-status-select').click(function(event) 
        {
          event.preventDefault();
          
          var status = $('#post_status').val(),
            text = $('#post_status option:selected').text();
          
          if (status != 'draft')
          {
            $('#save-post').val('Save');
            
            // TODO: Progress post status' these need to be updated to the next status!
            $('#hidden_post_status, #original_publish').val(text);
            $('#publish').val('Update');
          }
          
          $('#post-status-display').text(text);
        });
        
        $('#publish', '#major-publishing-actions').click(function()
        {
          if ($('#post-status-select').css('display') != 'none')
          {
            $('.save-post-status', '#post-status-select').trigger('click');
          }
          
          if ($('#post-visibility-select').css('display') != 'none')
          {
            $('.save-post-visibility', '#post-visibility-select').trigger('click');
          }
        });
      },
      
      widget: 'piklist-universal-widget',
      widget_interval: null,
      
      widgets_init: function()
      {
        $('.widget input[name="savewidget"]').live('mousedown', function()
        {
          $(this)
            .parents('.widget-control-actions')
            .siblings('.widget-content')
            .find('.hide-all:hidden :input')
            .not(':submit, :reset')
            .attr('value', '')
            .removeAttr('checked')
            .children('option:selected')
            .removeAttr('selected');
        });
          
        $('.' + piklist_admin.widget + '-forms .' + piklist_admin.widget + '-widget-form').hide();
        
        $('.' + piklist_admin.widget + '-form-selected').each(function()
        {
          var widget = $(this).parents('.widget-content'),
            classes = $(this).attr('class').split(' ');

          $(this).show();
          
          piklist_admin.widget_dimensions(classes, widget);
        });
        
        piklist_admin.widget_interval = setInterval(function()
        {
          $('#widgets-right .widget-inside:visible .' + piklist_admin.widget + '-forms .' + piklist_admin.widget + '-form-selected')
            .each(function(index)
            {
              if (typeof wptabs != 'undefined')
              {
                wptabs.setup();
              }
            
              $(this).fadeIn();
            })
            .piklistgroups()
            .piklistcolumns()
            .piklistmediaupload()
            .piklistaddmore({
              sortable: true
            })
            .piklistfields();
          
        }, 500);
      },

      widgets: function(object)
      {
        var widget = $(object).parents('.widget-content'),
          action = widget.parents('.widget').find('.widget-action'),
          selected = $(object).val();

        action.trigger('click');

        widget
          .find('.' + piklist_admin.widget + '-forms .' + piklist_admin.widget + '-form')
          .removeClass(piklist_admin.widget + '-form-selected')
          .hide();
        
        if (typeof selected != 'undefined')
        {
          selected = selected.split('--');
        
          var form = widget.find('.' + piklist_admin.widget + '-form-' + selected[1] + '--' + selected[2]),
            classes = form.attr('class').split(' ');
          
          form  
            .addClass(piklist_admin.widget + '-form-selected')
            .fadeIn();

          piklist_admin.widget_dimensions(classes, widget);
        }
        
        setTimeout(function()
        {
          action.trigger('click');
        }, 500);
      },
      
      widget_dimensions: function(classes, widget)
      {
        var height, width;
        
        for (var i = 0; i < classes.length; i++)
        {
          if (classes[i].indexOf('piklist-widget-width-') > -1)
          {
            width = parseFloat(classes[i].replace('piklist-widget-width-', ''));
          }
          else if (classes[i].indexOf('piklist-widget-height-') > -1)
          {
            height = parseFloat(classes[i].replace('piklist-widget-height-', ''));
          }
        }

        widget
          .siblings('input[name="widget-width"]')
          .val(width ? width : 250);

        widget
          .siblings('input[name="widget-height"]')
          .val(height ? height : 200);
      },
      
      list_tables: function()
      {
        $('.piklist-list-table-export-columns')
          .sortable()
          .disableSelection();
          
        $('.piklist-list-table-export-submit').live('click', function(event)
        {
          var form_id = $(this).attr('rel');
          
          tb_remove();
          
          $('#' + form_id).submit();
        });
      }
    };
  })(jQuery);



/* --------------------------------------------------------------------------------
  Updates or enhancements to existing WordPress Functionality
    - These should be submitted as patches to the core 
--------------------------------------------------------------------------------- */

  jQuery(document).ready(function() 
  { 
    wptabs.init();
  });
  
  var wptabs = {
    
    init: function()
    {
      this.setup();
      
      jQuery('.wp-tab-bar li a').live('click', function(event)
      {
        event.preventDefault(); 

        var tab = jQuery(this).closest('li');
        var index = jQuery(this).closest('.wp-tab-bar').children().index(tab);
        var panels = jQuery(this).closest('.wp-tab-bar').nextUntil('.wp-tab-bar', '.wp-tab-panel'); 

        tab.addClass('wp-tab-active').siblings().removeClass('wp-tab-active');

        for (var i = 0; i < panels.length; i++)
        {
          jQuery(panels[i]).toggle(i == index ? true : false); 
        }
      });
    },
    
    setup: function()
    {
      jQuery('.wp-tab-bar li a').each(function()
      {
        var tab = jQuery(this).closest('li');

        if (!tab.hasClass('wp-tab-active'))
        {
          var index = jQuery(this).closest('.wp-tab-bar').children().index(tab);

          jQuery(this).closest('.wp-tab-bar').nextUntil('.wp-tab-bar', '.wp-tab-panel').eq(index).hide();
        }
      });
    }
  };