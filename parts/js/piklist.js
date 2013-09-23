/* --------------------------------------------------------------------------------
  Updates or enhancements to Piklist Functionality
--------------------------------------------------------------------------------- */

  var piklist;

  (function($)
  {
    $(document).ready(function()
    {
      piklist.init();
    });
  
    piklist = {
    
      init: function()
      {
        if (typeof piklist_fields != 'undefined')
        {
          piklist.fields();
        }
      },
    
      fields: function()
      {      
        for (var id in piklist_fields) 
        {
          piklist.process_fields(id);
        }
      },
      
      process_fields: function(id)
      {
        var fields = piklist.to_array(piklist_fields[id]);
        for (var i in fields)
        {
          for (var j in fields[i])
          {
            if (!fields[i][j].display)
            {
              piklist.process_field(fields[i][j], id);
            }
          }
        }
      },
      
      processed_conditions: [],
      
      process_field: function(field, fields_id)
      {
        if (field.id && field.id.indexOf('__i__') > -1)
        {
          var widget = $('input[value="' + fields_id + '"]:last').parents('.widget').attr('id');
          var n = widget.charAt(widget.length - 1);
          
          if (!isNaN(parseFloat(n)) && isFinite(n))
          {
            field.id = field.id.toString().replace('__i__', n);
            field.name = field.name.toString().replace('__i__', n);
          }
          else
          {
            return false;
          }
        }

        if (field.conditions)
        {
          for (var i in field.conditions)
          {
            if (!piklist.processed_conditions[field.conditions[i].type])
            {
              piklist.processed_conditions[field.conditions[i].type] = [];
            }
            
            switch (field.conditions[i].type)
            {
              case 'update':
              
                var _field = field;

                $(document).delegate(':input[name="' + field.name + '"]', 'input propertychange change', piklist.conditions_handler(field.conditions[i].id, field.conditions[i]));
                $(':input:not(:radio)[name="' + field.name + '"], :radio:checked[name="' + field.name + '"]').trigger('input propertychange change');
              
                piklist.processed_conditions[field.conditions[i].type].push(field.name);
                              
              break;
            
              default:
                
                if ($.inArray(field.conditions[i].id, piklist.processed_conditions[field.conditions[i].type]) == -1)
                {
                  if (field.type == 'group' && field.field)
                  {
                    field_id = field.prefix ? '_' + field.field : field.id;
                  }
                  else
                  {
                    field_id = field.id;
                  }
                  
                  $(document).delegate('.' + field.conditions[i].id, 'change', piklist.conditions_handler(field_id, field.conditions[i]));
                  $(':input:not(:radio)[class~="' + field.conditions[i].id + '"], :radio:checked[class~="' + field.conditions[i].id + '"]').trigger('change');

                  piklist.processed_conditions[field.conditions[i].type].push(field.conditions[i].id);
                }
              
              break;
            }
          }
        }

        var options = typeof field.options === 'object' ? field.options : null;

        switch (field.type)
        {
          case 'datepicker':

            $(':input[name="' + field.name + '"]').each(function()
            {
              if (!$(this).hasClass('hasDatepicker'))
              {
                $(this)
                  .val($(this).val() ? $(this).val() : (!field.value ? null : field.value))
                  .attr('autocomplete', 'off')
                  .datepicker(options);
              }
            });
        
          break;
          
          case 'PiklistAddMore':
                    
            $('#' + field.id)
              .val($('#' + field.id).val() ? $('#' + field.id).val() : (!field.value ? null : field.value))
              .attr('autocomplete', 'off')
              .PiklistAddMore(options);
            
            $('.time-picker').addClass('ui-corner-all ui-widget');
                    
          break;
          
          case 'colorpicker':
            
            $(':input[name="' + field.name + '"]').wpColorPicker(options);

          break;
        }
        
        if (field.js_callback)
        {
          window[field.js_callback](field);
        }
      },
      
      to_array: function(object)
      {
        return $.map(object, function(o) 
        {
          return [$.map(o, function(v) 
          {
            return v;
          })];
        });
      },
          
      conditions_handler: function(id, condition) 
      {
        return function()
        {
          var field = $('#' + id);
          
          switch (condition.type)
          {
            case 'update':
              
              if (($(this).val() == condition.value || condition.value == ':any') || condition.force)
              {
                if (field.is(':radio') || field.is(':checkbox'))
                {
                  if ($(this).val() == '')
                  {
                    field.removeAttr('checked');
                  }
                  else
                  {
                    field.attr('checked', 'checked');
                  }
                }
                else
                {
                  field.val(condition.update);
                }
              }
              
            break;
            
            default:
              
              var options_page = $(this).parents('form').find(':input[name="option_page"]').length > 0;
              var parent = options_page ? 'tr' : '.piklist-field-condition';
              var element = $(this).prop('tagName') == 'LABEL' ? $(this).find(':input') : this;
              
              if ($(element).val() == condition.value && !$(element).is(':checkbox'))
              {
                if (field.hasClass('piklist-field-condition'))
                {
                  field.show();
                }
                else
                {
                  field.parents(parent).show();
                }
              }
              else if ($(element).val() == condition.value && $(element).is(':checkbox') && $(element).is(':checked'))
              {
                if (field.hasClass('piklist-field-condition'))
                {
                  field.show();
                }
                else
                {
                  field.parents(parent).show();
                }
              }
              else
              {
                if (field.is(':radio') || field.is(':checkbox'))
                {
                  field.attr('checked', false); 
                }
                else
                {
                  field.val('');
                }
                
                if ($(element).is(':input'))
                {
                  if (field.hasClass('piklist-field-condition'))
                  {
                    field.hide();
                  }
                  else
                  {
                    field.parents(parent).hide();
                  }
                }
              }
            
            break;
          }
          
          return false;
        };
      }
    
    };
  
  })(jQuery);



// The Newness

;(function($, window, document, undefined) 
{
  'use strict';
  
  $(document).ready(function()
  {  
    $('body')
      .piklistcolumns()
      .piklistmediaupload();
    
    $('*[data-piklist-field-addmore="true"]')
      .piklistaddmore({
        sortable: true
      });
      
    $('.wp-editor-wrap').each(function()
    {
      var $parent = $($(this).parent());
      
      if ($parent.hasClass('piklist-field'))
      {
        $parent.css({
          'float': 'none',
          'width': 'auto',
          'padding': 0
        });
      }
    });  
  });

  /* --------------------------------------------------------------------------------
    Piklist Add More - Creates Add More fields for Piklist
  -------------------------------------------------------------------------------- */
  
  var PiklistAddMore = function(element, options)
  {
    this.$element = $(element);
    this.add = options.add;
    this.remove = options.remove;
    this.move = options.move;

    this.set = this.$element.attr('name');
    this.sortable = options.sortable;
    
    this._init();
  };
  
  PiklistAddMore.prototype = {

    constructor: PiklistAddMore,

    _init: function() 
    {
      this.setup();
    },

    setup: function()
    {
      var group = this.$element.attr('data-piklist-field-group'),
        $wrapper = $('<div />')
                     .attr('data-piklist-field-addmore', this.set)
                     .addClass('piklist-field-addmore-wrapper'),
        $wrapper_actions = $('<div />')
                              .addClass('piklist-field-addmore-wrapper-actions')
                              .css('display', 'inline');
      
			if (this.$element.is(':checkbox, :radio'))
			{
				// TODO: How to Handle?
			}
			else
			{
	      if (typeof group === 'undefined')
	      {
	        this.$element
            .siblings('label[for="' + this.$element.attr('name') + '"]')
            .andSelf()
            .wrapAll($wrapper);
	      }
	      else
	      {
	        var set = $('div[data-piklist-field-group="' + group + '"], div[data-piklist-field-sub-group="' + group + '"]');
          
	        this.$element = set.last();

          set = $.merge(set, $(set.last()));

          set.wrapAll($wrapper);
	      }
			}

      $wrapper_actions.prepend($(this.add)
        .attr('data-piklist-field-addmore-action', 'add')
        .click(this.action_handler)
      );
              
      $wrapper_actions.prepend($(this.remove)
        .attr('data-piklist-field-addmore-action', 'remove')
        .click(this.action_handler)
      );
      
      if (this.sortable)
      {
        var container = this.$element
          .parent('div[data-piklist-field-addmore="' + this.set + '"]')
          .parent();

        if (!container.hasClass('ui-sortable'))
        {
          container  
            .sortable({
              items: '> div[data-piklist-field-addmore]',
              cursor: 'move'
            })
            .disableSelection();
        }
      }

      var $element_last = this.$element
                            .parent('div.piklist-field-addmore-wrapper')
                            .children('div[data-piklist-field-group="' + group + '"]:last');
      
			if (this.$element.is(':checkbox, :radio'))
			{
				// TODO: How to Handle?
			}
			else
			{		
				$wrapper_actions.insertAfter($element_last.length > 0 ? $element_last : this.$element);
    	}
		},
    
    action_handler: function(event)
    {
      var $element = $(this),
        $wrapper = $element.parents('div.piklist-field-addmore-wrapper:first'),
        count = $wrapper.siblings('div.piklist-field-addmore-wrapper').length,
        element = $wrapper.attr('data-piklist-field-addmore'),
        element_indexes = element ? element.replace(/\]/g, '').split('[') : [],
        groups = 0;
        
      for (var j = element_indexes.length - 1; j >= 0; j--)
      {
        if ($.isNumeric(element_indexes[j]))
        {
          groups = groups + 1;
        }
      }

      switch ($element.attr('data-piklist-field-addmore-action'))
      {
        case 'add':
        
          var $clone = $wrapper.clone(true);

          $clone
            .find('div[data-piklist-field-addmore]')
            .each(function()
            {
              $(this)
                .siblings('div[data-piklist-field-addmore]')
                .remove();
            });
          
          $clone
            .find(':input')
            .removeAttr('id')
            .removeAttr('value')
            .removeClass('hasDatepicker')
            .off();
                    
          $clone.insertAfter($wrapper);
 
          $wrapper
            .parent()
            .children('div.piklist-field-addmore-wrapper')
            .each(function(i)
            {
              $(this).find(':input').each(function()
              {
                var name = $(this).attr('name'),
                  indexes = name.replace(/\]/g, '').split('['),
                  scope = indexes[0];
                
                for (var j = 0; j < indexes.length; j++)
                {
                  if ($.isNumeric(indexes[j]))
                  {
                    if ($wrapper.parents('div.piklist-field-addmore-wrapper').length == 0)
                    {
                      indexes[j] = i;
                    }
                  }
                  indexes[j] = indexes[j] + (scope !== indexes[j] ? ']' : '');
                }
                
                $(this).attr('name', indexes.join('['));
                $('*[for="' + name + '"]').attr('for', indexes.join('['));
              });
            });
            
            piklist.fields();
            
        break;
        
        case 'remove':
          
          if (count > 0)
          {
            $wrapper.remove();
          }
          
        break;
      }
      
      event.preventDefault();
      event.stopPropagation();        
    }
  };
  
  $.fn.piklistaddmore = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();
  
    return this.each(function() 
    {
      var $this = $(this),
        data = $this.data('piklistaddmore'),
        options = typeof option === 'object' && option;
  
      if (!data) 
      {
        $this.data('piklistaddmore', (data = new PiklistAddMore(this, $.extend({}, $.fn.piklistaddmore.defaults, options, $(this).data()))));
      }
  
      if (typeof option === 'string') 
      {
        data[option].apply(data, _arguments);
      }
    });
  };
  
  $.fn.piklistaddmore.defaults = {
    add: '<a href="#" class="button button-primary piklist-add-more-add">+</a>',
    remove: '<a href="#" class="button button-secondary piklist-add-more-remove">&ndash;</a>',
    move: '<span class="piklist-add-more-move">&varr;</span>',
    sortable: false
  };
  
  $.fn.piklistaddmore.Constructor = PiklistAddMore;

  /* --------------------------------------------------------------------------------
    Piklist Columns - Creates fluid column based layout
  -------------------------------------------------------------------------------- */
  
  var PiklistColumns = function(element, options)
  {
    this.$element = $(element);
    this.total_columns = options.total_columns;
		this.gutter_width = options.gutter_width;
		this.gutter_height = options.gutter_height;
    
    this._init();
  };
  
  PiklistColumns.prototype = {

    constructor: PiklistColumns,

    _init: function() 
    {
      var total_columns = this.total_columns,
				gutter_width = this.gutter_width,
			  gutter_height = this.gutter_height,
				track = {
				  columns: 0,
				  gutters: 0,
				  group: false
				};
      
      this.$element
        .find('*[data-piklist-field-columns]:not(:radio, :checkbox)')
        .each(function()
        {
          var $element = $(this),
            columns = parseFloat($element.data('piklist-field-columns')),
            group = $element.data('piklist-field-group'),
            sub_group = $element.data('piklist-field-sub-group');

          $element
            .siblings('label[for="' + $element.attr('name') + '"]:first')
            .andSelf()
            .wrapAll('<div data-piklist-field-columns="' + columns + '" data-piklist-field-group="' + group + '" ' + (sub_group ? 'data-piklist-field-sub-group="' + sub_group + '"' : '') +' />');
              
          $element
            .css({
              'width': $element.attr('size') ? 'auto' : '100%',
            })
            .parent('div[data-piklist-field-columns]')
            .css({
              'display': 'block',
              'float': 'left',
              'width': ((columns / total_columns) * 100) - gutter_width + '%',
              'margin-left': gutter_width + ($.isNumeric(gutter_width) ? '%' : null),
              'margin-bottom': gutter_height + ($.isNumeric(gutter_height) ? '%' : null)
            });   
        });

			this.$element
      	.find('*[data-piklist-field-columns]')
				.filter(':radio, :checkbox')
        .each(function()
        {
          var $element = $(this),
            columns = parseFloat($element.data('piklist-field-columns')),
            group = $element.data('piklist-field-group'),
            sub_group = $element.data('piklist-field-sub-group');
					
          $element
            .parents('.piklist-field-list')
          	.each(function()
						{
							if ($(this).parent('div[data-piklist-field-columns]').length == 0)
							{
								$(this)
                  .siblings('.piklist-label[for="' + $element.attr('name') + '"]:first')
									.andSelf()
                  .wrapAll('<div data-piklist-field-columns="' + columns + '" data-piklist-field-group="' + group + '" ' + (sub_group ? 'data-piklist-field-sub-group="' + sub_group + '"' : '') +' />')
									.parent('div[data-piklist-field-columns]')
									.css({
                    'display': 'block',
                    'float': 'left',
			              'width': ((columns / total_columns) * 100) - gutter_width + '%',
                    'margin-left': gutter_width + ($.isNumeric(gutter_width) ? '%' : null),
                    'margin-bottom': gutter_height + ($.isNumeric(gutter_height) ? '%' : null)
			            });
							}
						});  
        });
        
        this.$element
          .find('div[data-piklist-field-columns]')
          .each(function(i)
          {
            var $element = $(this),
              columns = parseFloat($element.data('piklist-field-columns')),
              group = $element.data('piklist-field-group');

            $element.addClass('piklist-field-column');
            
            if (track.group && track.group != group)
            {
              track = {
      				  columns: 0,
      				  gutters: 0,
      				  group: group
              };
            }
            
            if (track.columns == 0)
            {
              $element
                .addClass('piklist-field-column-first')
                .css({
                  'margin-left': '0'
                });
            }
            
            track = {
    				  columns: track.columns + columns,
    				  gutters: track.gutters + 1,
    				  group: group
            };
            
            if (track.columns >= total_columns)
            {
              $element.addClass('piklist-field-column-last');

              track = {
      				  columns: 0,
      				  gutters: 0,
      				  group: false
              };
            }
          });
          
        this.$element
          .find('.piklist-field-column-first')
          .each(function(i)
          {
            var $element = $(this),
              $next = $element,
              columns = parseFloat($element.data('piklist-field-columns')),
              total_gutters = 0;
            
            if (!$element.hasClass('piklist-field-column-last'))
            {
              do {
                total_gutters++;
                
                $next = $next.next();
              }  while ($next.length > 0 && !$next.hasClass('piklist-field-column-last') && $next.data('piklist-field-columns')) 
            }
            
            var total_width = 100 - total_gutters * gutter_width,
              $next = $element;

            do {
              columns = parseFloat($next.data('piklist-field-columns'));
              
              $next
                .css({
                  'width': ((columns / total_columns) * total_width) + '%'
                });

              $next = $next.next();
            }  while ($next.length > 0 && !$next.hasClass('piklist-field-column-first') && $next.data('piklist-field-columns'))
            
            total_gutters = 0;
          });
    }
  };
  
  $.fn.piklistcolumns = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();
  
    return this.each(function() 
    {
      var $this = $(this),
        data = $this.data('piklistcolumns'),
        options = typeof option === 'object' && option;
  
      if (!data) 
      {
        $this.data('piklistcolumns', (data = new PiklistColumns(this, $.extend({}, $.fn.piklistcolumns.defaults, options, $(this).data()))));
      }
  
      if (typeof option === 'string') 
      {
        data[option].apply(data, _arguments);
      }
    });
  };
  
  $.fn.piklistcolumns.defaults = {
    total_columns: 12,
		gutter_width: 2.5,
		gutter_height: '7px'
  };
  
  $.fn.piklistcolumns.Constructor = PiklistColumns;
  
  /* --------------------------------------------------------------------------------
    Piklist Media Upload - Handles the File Upload Field
  -------------------------------------------------------------------------------- */
  
  var PiklistMediaUpload = function(element, options)
  {
    this.$element = $(element);
    this._init();
  };
  
  PiklistMediaUpload.prototype = {

    constructor: PiklistMediaUpload,

    _init: function() 
    {
      var media_frame;
      
      $('.piklist-upload-file-preview .attachments')
        .sortable({
          items: 'li.attachment',
          cursor: 'move',
          update: function(event, ui) 
          {
            var attachments = $(this).find('[data-attachment-id]'),
              input_name = $(attachments[0]).data('attachments'),
              input = $(':input[name="' + input_name + '"]'),
              updates = [];
          
            attachments.each(function(i)
            {
              updates.push($(this).data('attachment-id'));
            });
            
            $(':input[name="' + input_name + '"]:not(:first)').remove();
            
            input.val(updates.shift());

            for (var i = 0; i < updates.length; i++)
            {
              $(input
                  .first()
                  .clone()
                  .removeAttr('id')
                  .val(updates[i])
                ).insertAfter($(':input[name="' + input_name + '"]:last'));
            }
          }
        })
        .disableSelection();
          
      $('.piklist-upload-file-preview .attachment').live('click', function(event)
      {
        event.preventDefault();
      
        $(this)
          .parents('.piklist-upload-file-preview:first')
          .prev('.piklist-upload-file-button')
          .trigger('click');
      });
      
      $('.piklist-upload-file-preview .attachment .check').live('click', function(event)
      {
        event.preventDefault();
        
        var index = $($(this).parents('.attachment:first')).index($(this).parents('attachments:first')),
          name = $(this).data('attachments'),
          value = $(this).data('attachment-id');
        
        if ($(':input[name="' + name + '"]').length == 1)
        {
          $(':input[name="' + name + '"][value="' + value + '"]:eq(' + index + ')').val('')
        }
        else
        {
          $(':input[name="' + name + '"][value="' + value + '"]:eq(' + index + ')').remove();
        }
        
        $(this)
          .parents('.attachment:first')
          .remove();
      });
      
      $('.piklist-upload-file-button').live('click', function(event)
      {
        event.preventDefault();
      
        var button = $(this);
      
        if (media_frame) 
        {
          media_frame.open();
          return;
        }
      
        media_frame = wp.media.frames.file_frame = wp.media({
          title: button.attr('title'),
          button: {
            text: button.text(),
          },
          multiple: true
        });
      
        media_frame.on('select', function()
        {
          var attachments = media_frame.state().get('selection'),
            input = button.prev(':input[type="hidden"]'),
            input_name = input.attr('name'),
            preview = button.next('.piklist-upload-file-preview').find('ul.attachments'),
            updates = [];
      
          attachments.map(function(attachment) 
          {
            attachment = attachment.toJSON();
        
            if (attachment.sizes)
            {
              var display = attachment.sizes.full;
      
              if (attachment.sizes.thumbnail)
              {
                display = attachment.sizes.thumbnail;
              }
              else if (attachment.sizes.medium)
              {
                display = attachment.sizes.medium;
              }
              else if (attachment.sizes.large)
              {
                display = attachment.sizes.large;
              }
              
              preview.append(
                $('<li class="attachment selected">\
                      <div class="attachment-preview ' + (display.width > display.height ? 'landscape' : 'portrait') + '">\
                        <div class="thumbnail">\
                          <div class="centered">\
                            <a href="#">\
                             <img src="' + display.url + '" />\
                           </a>\
                          </div>\
                        </div>\
                        <a class="check" href="#" title="Deselect" data-attachment-id="' + attachment.id + '" data-attachments="' + input.attr('name') + '"><div class="media-modal-icon"></div></a>\
                      </div>\
                   </li>\
                 ')
              );
            }
            else
            {
              var display = attachment;

              preview.append(
                $('<li class="attachment selected">\
                      <div class="attachment-preview type-' + display.type + ' subtype-' + display.subtype + ' landscape">\
                        <img src="' + display.icon + '" class="icon" />\
                        <div class="filename">\
                          <div>' + display.filename + '</div>\
                        </div>\
                        <a class="check" href="#" title="Deselect" data-attachment-id="' + attachment.id + '" data-attachments="' + input.attr('name') + '"><div class="media-modal-icon"></div></a>\
                      </div>\
                   </li>\
                 ')
              );
            }
      
            updates.push(attachment.id);
          });
          
          for (var i = 0; i < updates.length; i++)
          {
            $(input
                .first()
                .clone()
                .removeAttr('id')
                .val(updates[i])
              ).insertAfter($(':input[name="' + input_name + '"]:last'));
          }
        });
      
        media_frame.open();
      });          
    }
  };
  
  $.fn.piklistmediaupload = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();
  
    return this.each(function() 
    {
      var $this = $(this),
        data = $this.data('piklistmediaupload'),
        options = typeof option === 'object' && option;
  
      if (!data) 
      {
        $this.data('piklistmediaupload', (data = new PiklistMediaUpload(this, $.extend({}, $.fn.piklistmediaupload.defaults, options, $(this).data()))));
      }
  
      if (typeof option === 'string') 
      {
        data[option].apply(data, _arguments);
      }
    });
  };
  
  $.fn.piklistmediaupload.defaults = {};
  
  $.fn.piklistmediaupload.Constructor = PiklistMediaUpload;

})(jQuery, window, document);

