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
        piklist_admin.post_submit_meta_box();
        piklist_admin.thickbox();
				piklist_admin.user_forms();
        // piklist_admin.list_tables();
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
          setTimeout(function() {
            var TB_WIDTH = 870,
              TB_HEIGHT = 700; 
              console.log('asdf');
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

        $('.wp-editor-wrap')
          .parent()
          .css({
            'clear': 'both'
            ,'overflow': 'auto'
            ,'border': 'none'
          })
          .prev(':not(h2)')
          .css({
            'width': 'auto'
            ,'border': 'none'
          });
      },
      
      post_submit_meta_box: function()
      {
        $('.save-post-status', '#post-status-select').click(function(event) 
        {
          event.preventDefault();
          
          var status = $('#post_status').val();
          
          if (status != 'draft')
          {
            $('#save-post').val('Save');
            
            // TODO: Progress post status' these need to be updated to the next status!
            $('#hidden_post_status, #original_publish').val(status);
            $('#publish').val('Update');
          }
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
            .children('option:selected').removeAttr('selected');
        });
          
        $('.' + piklist_admin.widget + '-forms .' + piklist_admin.widget + '-widget-form').hide();
        $('.' + piklist_admin.widget + '-form-selected').show();
        
        piklist_admin.widgets(false);
        
        piklist_admin.widget_interval = setInterval(function()
        {
          $('#widgets-right .widget-inside:visible .' + piklist_admin.widget + '-forms .' + piklist_admin.widget + '-form-selected').each(function(index)
          {
            piklist.process_fields($(this).parent('.' + piklist_admin.widget + '-forms').find('input#piklist_fields_id').val());
            
            $(this).fadeIn();
          });
        }, 1000);
      },

      widgets: function(object)
      {
        var widget = $(object).parents('.widget-content');

        widget
          .find('.' + piklist_admin.widget + '-forms .' + piklist_admin.widget + '-form')
          .removeClass(piklist_admin.widget + '-form-selected')
          .hide();
          
        var selected = $(object).val();
        if (typeof selected != 'undefined')
        {
          selected = selected.split('--');
          
          widget
            .find('.' + piklist_admin.widget + '-form-' + selected[1] + '--' + selected[2])
            .addClass(piklist_admin.widget + '-form-selected')
            .fadeIn();
        }
        
        widget.find('div[class*="piklist-widget-width-"], div[class*="piklist-widget-height-"]').each(function()
        {
          var height, width, classes = $(this).attr('class').split(' ');
          
          if ($(this).is(':visible'))
          {
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
          }

          widget
            .siblings('input[name="widget-width"]')
            .val(width ? width : 250);
            
          widget
            .siblings('input[name="widget-height"]')
            .val(height ? height : 200);
        });
        
        if (object)
        {
          var action = widget.parents('.widget').find('.widget-action');
          action.trigger('click');
          setTimeout(function()
          {
            action.trigger('click');
          }, 500);
        }
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

  jQuery(document).ready(function($) 
  { 
    $('.wp-tab-bar li a').each(function()
    {
      var tab = $(this).closest('li');

      if (!tab.hasClass('wp-tab-active'))
      {
        var index = $(this).closest('.wp-tab-bar').children().index(tab);
        
        $(this).closest('.wp-tab-bar').nextUntil('.wp-tab-bar', '.wp-tab-panel').eq(index).hide();
      }

      $(this).click(function(event)
      {
        event.preventDefault(); 

        var tab = $(this).closest('li');
        var index = $(this).closest('.wp-tab-bar').children().index(tab);
        var panels = $(this).closest('.wp-tab-bar').nextUntil('.wp-tab-bar', '.wp-tab-panel'); 
                
        tab.addClass('wp-tab-active').siblings().removeClass('wp-tab-active');
        
        for (var i = 0; i < panels.length; i++)
        {
          $(panels[i]).toggle(i == index ? true : false); 
        }
      });
    });
  });
