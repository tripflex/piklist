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

            $('#' + field.id)
              .val($('#' + field.id).val() ? $('#' + field.id).val() : (!field.value ? null : field.value))
              .attr('autocomplete', 'off')
              .datepicker(options);
        
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
                  field.show('slow');
                }
                else
                {
                  field.parents(parent).show('slow');
                }
              }
              else if ($(element).val() == condition.value && $(element).is(':checkbox') && $(element).is(':checked'))
              {
                if (field.hasClass('piklist-field-condition'))
                {
                  field.show('slow');
                }
                else
                {
                  field.parents(parent).show('slow');
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
                    field.hide('slow');
                  }
                  else
                  {
                    field.parents(parent).hide('slow');
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
    $('*[data-piklist-field-addmore="true"]').piklistaddmore({
      sortable: true
    });
    
    $('body').piklistcolumns();
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
	        this.$element.wrap($wrapper);
	      }
	      else
	      {
	        var set = $('*[data-piklist-field-group="' + group + '"], *[data-piklist-field-sub-group="' + group + '"]');
				
	        this.$element = set.last();
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
        $wrapper_actions.prepend($(this.move));
        
        var container = this.$element
          .parent('div[data-piklist-field-addmore="' + this.set + '"]')
          .parent();

        if (!container.hasClass('ui-sortable'))
        {
          container  
            .sortable({
              items: '> div[data-piklist-field-addmore]',
              cursor: 'move'
            });
            
          container.disableSelection();
        }
      }

      var $element_last = this.$element
                            .parent('div.piklist-field-addmore-wrapper')
                            .children('*[data-piklist-field-group="' + group + '"]:last');
      
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
        $wrapper = $element.parents('div[data-piklist-field-addmore]:first'),
        count = $wrapper.siblings('div.piklist-field-addmore-wrapper').length,
        element = $wrapper.attr('data-piklist-field-addmore'),
        element_indexes = element.replace(/\]/g, '').split('['),
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
            .removeAttr('value');
                    
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
                  scope = indexes[0],
                  index = 0;

                for (var j = 0; j < indexes.length; j++)
                {
                  if ($.isNumeric(indexes[j]))
                  {
                    index = index + 1;
                    if (groups === index)
                    {
                      indexes[j] = i;
                    }
                  }
                  indexes[j] = indexes[j] + (scope !== indexes[j] ? ']' : '');
                }

                $(this).attr('name', indexes.join('['));
              });
            });
            
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
    remove: '<a href="#" class="button button-secondary piklist-add-more-remove">-</a>',
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
    
    this._init();
  };
  
  PiklistColumns.prototype = {

    constructor: PiklistColumns,

    _init: function() 
    {
      var total_columns = this.total_columns,
				gutter_width = this.gutter_width;

      this.$element
        .find('*[data-piklist-field-columns]:not(:radio, :checkbox)')
        .each(function()
        {
          var $element = $(this),
            columns = parseFloat($element.attr('data-piklist-field-columns'));

          $element
            .prev('label')
            .andSelf()
            .wrapAll('<div data-piklist-field-columns="true" />');
          
          $element
            .css({
              'width': $element.attr('size') ? 'auto' : '100%'
            })
            .parent('div[data-piklist-field-columns="true"]')
            .css({
              'display': 'block',
              'float': 'left',
              'width': ((columns / total_columns) * 100) - gutter_width + '%',
              'margin-right': gutter_width + '%'
            });       
        });

			this.$element
      	.find('*[data-piklist-field-columns]')
				.filter(':radio, :checkbox')
        .each(function()
        {
          var $element = $(this),
            columns = parseFloat($element.attr('data-piklist-field-columns'));
					
          $element
            .parents('.piklist-field-list')
          	.each(function()
						{
							if ($(this).parent('div[data-piklist-field-columns="true"]').length == 0)
							{
								$(this)
									.prev('.piklist-label')
									.andSelf()
									.wrapAll('<div data-piklist-field-columns="true" />')
									.parent('div[data-piklist-field-columns="true"]')
									.css({
			              'display': 'block',
			              'float': 'left',
			              'width': ((columns / total_columns) * 100) - gutter_width + '%',
			              'margin-right': gutter_width + '%'
			            });
							}
						});  
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
		gutter_width: 2.5
  };
  
  $.fn.piklistcolumns.Constructor = PiklistColumns;

})(jQuery, window, document);

  