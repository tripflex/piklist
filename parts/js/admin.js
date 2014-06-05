/* --------------------------------------------------------------------------------
  Updates or enhancements to Piklist Functionality
--------------------------------------------------------------------------------- */

;(function($, window, document, undefined) 
{
  'use strict';

  $(document).ready(function()
  {  
    $('body')
      .wptabs();
      
    piklist_admin.init();
  });
  
  
  
  var piklist_admin = {
  
    init: function()
    {
      piklist_admin.meta_boxes();
      piklist_admin.post_name();
      piklist_admin.post_submit_meta_box();
      piklist_admin.thickbox();
      piklist_admin.user_forms();
      piklist_admin.empty_elements();
      piklist_admin.list_tables();
      piklist_admin.widgets_init();
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
      if ('WebkitAppearance' in document.documentElement.style) 
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
      $(document).on('click', '.piklist-list-table-export-button', function() 
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
    
    widgets_init: function()
    {
      $(document).on('mousedown', '.widget input[name="savewidget"]', function()
      {
        var button = $(this),
          widget_container = button.parents('.widget-control-actions:first').siblings('.widget-content:first');
        
        $('.piklist-universal-widget-form-container').on('remove', function() 
        {
          widget_container
            .css({
              'height': widget_container.outerHeight(),
              'overflow': 'hidden'
            });
            
          widget_container
            .removeData('wptabs')
            .removeData('piklistgroups')
            .removeData('piklistcolumns')
            .removeData('piklistmediaupload')
            .removeData('piklistaddmore')
            .removeData('piklistfields');
              
          setTimeout(function()
          {
            widget_container
              .find('.piklist-universal-widget-form-container')
              .wptabs()
              .piklistgroups()
              .piklistcolumns()
              .piklistmediaupload()
              .piklistaddmore({
                sortable: true
              })
              .piklistfields();

            widget_container
              .css({
                'height': 'auto',
                'overflow': 'visible'
              });
          }, 50);
        });
      });
              
      $('.piklist-universal-widget-form-container').each(function()
      {
        var widget_container = $(this).parents('.widget-content'),
          widget_title = $(this).parents('.widget').find('.widget-title h4'),
          title = $(this).attr('data-widget-title'),
          height = $(this).attr('data-widget-height'),
          width = $(this).attr('data-widget-width');
        
        if (typeof title != 'undefined')
        {
          widget_title
            .find('.in-widget-title')
            .text(':  ' + title);
        }
            
        piklist_admin.widget_dimensions(widget_container, height, width);
      });
      
      $(document).on('change', '.piklist-universal-widget-select', function()
      {
        var widget = $(this).val(),
          addon = $(this).attr('data-piklist-addon'),
          action = ('piklist-universal-widget-' + addon).replace(/-/g, '_'),
          widget_container = $(this).parents('.widget-content'),
          widget_classes = $(this).attr('class').split(' '),
          widget_form = widget_container.find('.piklist-universal-widget-form-container'),
          widget_number = $(this).attr('name').split('[')[1].replace(/\]/g, ''),
          widget_title = $(this).parents('.widget').find('.widget-title h4'),
          widget_description = widget_container.find('.piklist-universal-widget-select-container p'),
          wptab_active = widget_container.attr('data-piklist-wptab-active');
        
        if (widget)
        {
          widget_form
            .hide()
            .empty();
          
          $.ajax({
            type : 'POST',
            url : ajaxurl,
            async: false,
            data: {
              action: action,
              widget: widget,
              number: widget_number
            }
            ,success: function(response) 
            {
              response = $.parseJSON(response);
              
              widget_title
                .find('.in-widget-title')
                .text(':  ' + response.widget.data.title)
                
              widget_description.text(response.widget.data.description);
             
              widget_form
                .removeData('wptabs')
                .removeData('piklistgroups')
                .removeData('piklistcolumns')
                .removeData('piklistmediaupload')
                .removeData('piklistaddmore')
                .removeData('piklistfields');
              
              widget_form
                .html(response.form)
                .wptabs()
                .piklistgroups()
                .piklistcolumns()
                .piklistmediaupload()
                .piklistaddmore({
                  sortable: true
                })
                .piklistfields();
              
              widget_container
                .find('.wp-tab-bar > li')
                .removeClass('wp-tab-active');
              
              widget_container
                .find('.wp-tab-bar > li:first')
                .addClass('wp-tab-active');
                  
              if (widget_container.find('.wp-tab-bar').length > 0 && typeof wptab_active != 'undefined')
              {
                widget_container
                  .find('.wp-tab-bar > li')
                  .removeClass('wp-tab-active')
                  .get(2)
                  .addClass('wp-tab-active');
              }
                          
              piklist_admin.widget_dimensions(widget_container, response.widget.form_data.height, response.widget.form_data.width);
            }
          });
          
        }
      });
      
      $('.wp-tab-bar li a').on('click', function(event)
      {
        var widget_container = $(this).parents('.widget-content:first');
        
        if (widget_container.length > 0)
        {
          widget_container.attr('data-piklist-wptab-active', $(this).text());
        }
      });
    },
    
    widget_dimensions: function(widget, height, width)
    {
      var container = widget.parents('.widget:first'),
        inside = container.find('.widget-inside'),
        toggle = container.find('.widget-action:first'),
        toggled = false;
        
      if (inside.is(':visible'))
      {
        toggle.trigger('click');
        
        toggled = true;
      }
      
      widget
        .siblings('input[name="widget-width"]')
        .val(width ? width : 250);

      widget
        .siblings('input[name="widget-height"]')
        .val(height ? height : 200);

      setTimeout(function()
      {
        widget
          .find('.piklist-universal-widget-form-container')
          .show();
        
        if (toggled)
        {
          toggle.trigger('click');
        }
      }, 250);
    },
    
    list_tables: function()
    {
      $('.piklist-list-table-export-columns')
        .sortable()
        .disableSelection();
        
      $(document).on('click', '.piklist-list-table-export-submit', function(event)
      {
        var form_id = $(this).attr('rel');
        
        tb_remove();
        
        $('#' + form_id).submit();
      });
    }
  };
  
  
  
  
  
  
      
  /* --------------------------------------------------------------------------------
    WP Tabs - Updates or enhancements to existing WordPress Functionality
        - These should be submitted as patches to the core 
  -------------------------------------------------------------------------------- */
  
  var WPTabs = function(element, options)
  {
    this.$element = $(element);
    this._init();
  };
  
  WPTabs.prototype = {

    constructor: WPTabs,

    _init: function()
    {
      this.setup();
      
      $(document).on('click', '.wp-tab-bar li a', function(event)
      {
        event.preventDefault(); 

        var tab = $(this).closest('li'),
          index = $(this).closest('.wp-tab-bar').children().index(tab),
          panels = $(this).closest('.wp-tab-bar').nextUntil('.wp-tab-bar', '.wp-tab-panel'); 

        tab.addClass('wp-tab-active').siblings().removeClass('wp-tab-active');
        
        for (var i = 0; i < panels.length; i++)
        {
          $(panels[i]).toggle(i == index ? true : false); 
        }
      });
    },
    
    setup: function()
    {
      $('.wp-tab-bar li a').each(function()
      {
        var tab = $(this).closest('li');

        if (!tab.hasClass('wp-tab-active'))
        {
          var index = $(this).closest('.wp-tab-bar').children().index(tab);
          
          $(this).closest('.wp-tab-bar').nextUntil('.wp-tab-bar', '.wp-tab-panel').eq(index).hide();
        }
      });
    }
  };
  
  $.fn.wptabs = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();
  
    return this.each(function() 
    {
      var $this = $(this),
        data = $this.data('wptabs'),
        options = typeof option === 'object' && option;

      if (!data) 
      {
        $this.data('wptabs', (data = new WPTabs(this, $.extend({}, $.fn.wptabs.defaults, options, $(this).data()))));
      }
  
      if (typeof option === 'string') 
      {
        data[option].apply(data, _arguments);
      }
    });
  };
  
  $.fn.wptabs.defaults = {};
  
  $.fn.wptabs.Constructor = WPTabs;

})(jQuery, window, document);
  