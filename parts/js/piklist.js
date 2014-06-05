
;(function($, window, document, undefined) 
{
  'use strict';
  
  $(document).ready(function()
  {  
    $('body')
      .piklistgroups()
      .piklistcolumns()
      .piklistmediaupload()
      .piklistaddmore({
        sortable: true
      })
      .piklistfields();
    
    // NOTE: WordPress Updates to allow meta boxes and widgets to have tinymce
    $('.meta-box-sortables, div.widgets-sortables')
      .on('sortstart', function(event, ui) 
      {
        if ($(this).is('.meta-box-sortables, div.widgets-sortables'))
        {
          $(this).find('.wp-editor-area').each(function()
          {
            if (typeof switchEditors != 'undefined')
            {
              var id = $(this).attr('id');
          
              switchEditors.go(id, 'tmce')
          
              tinyMCE.execCommand('mceRemoveControl', false, id);
            }
          });
        }
      })
      .on('sortstop', function(event, ui) 
      {
        if ($(this).is('.meta-box-sortables, div.widgets-sortables'))
        {
          $(this).find('.wp-editor-area').each(function()
          {
            if (typeof switchEditors != 'undefined')
            {
              var id = $(this).attr('id');
          
              tinyMCE.execCommand('mceAddControl', true, $(this).attr('id'));
            }
          });
        }
      });
  });
  
  
  
  
  
  
  
  
  
  
  
  /* --------------------------------------------------------------------------------
    Piklist Fields - Sets up Field rules and handles dynamic fields
  -------------------------------------------------------------------------------- */
  
  var PiklistFields = function(element, options)
  {
    this.$element = $(element);

    this._init();
  };
  
  PiklistFields.prototype = {

    constructor: PiklistFields,
    
    processed_conditions: [],

    _init: function()
    {
      if (typeof piklist_fields != 'undefined')
      {
        this.fields();
      }
    },
  
    fields: function()
    {      
      for (var id in piklist_fields) 
      {
        this.process_fields(id);
      }
    },
    
    process_fields: function(id)
    {
      var fields = this.to_array(piklist_fields[id]);
      
      for (var i in fields)
      {
        for (var j in fields[i])
        {
          if (!fields[i][j].display)
          {
            this.process_field(fields[i][j], id);
          }
        }
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
    
    process_field: function(field, fields_id)
    {
      if (field.id && field.id.indexOf('__i__') > -1)
      {
        var widget = $('input[value="' + fields_id + '"]:last').parents('.widget').attr('id'),
          n = widget.charAt(widget.length - 1);
        
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
        var field_id,
          type,
          key;
                    
        for (var i in field.conditions)
        {
          type = typeof field.conditions[i].type == 'undefined' ? 'toggle' : field.conditions[i].type;
          
          if (!this.processed_conditions[type])
          {
            this.processed_conditions[type] = [];
          }
          
          switch (type)
          {
            case 'update':
            
              var _field = field,
                field_selector = '#' + field.conditions[i].id,
                key = field.name;

              $(':input[name="' + field.name + '"]').on('input propertychange change', {
                selector: field_selector, 
                condition: field.conditions[i]
              }, this.conditions_handler);
              
              $(':input:not(:radio)[name="' + field.name + '"], :radio:checked[name="' + field.name + '"]').trigger('input propertychange change');
              
              this.processed_conditions[type].push(field.name);
                            
            break;
          
            default:
              
              field_selector = '[name="' + field.name + '"]';
              key = field_selector + ':' + field.conditions[i].id; 
              
              if ($.inArray(key, this.processed_conditions[type]) == -1)
              {
                $('.' + field.conditions[i].id).on('input propertychange change', {
                  selector: field_selector, 
                  condition: field.conditions[i]
                }, this.conditions_handler);
                
                $(':input:not(:radio)[class~="' + field.conditions[i].id + '"], :radio:checked[class~="' + field.conditions[i].id + '"]').trigger('change');
                  
                this.processed_conditions[type].push(key);
              }
            
            break;
          }
        }
      }

      var options = typeof field.options === 'object' ? field.options : null;

      switch (field.type)
      {
        case 'editor':

          $('textarea[name="' + field.name + '"]').each(function()
          {
            var id = $(this).attr('id')
            
            if (typeof id == 'undefined')
            {
              var original_id = $(this).attr('data-piklist-original-id'),
                name = $(this).attr('name'),
                $editor_wrap = $(this).parents('.wp-editor-wrap:first');
              
              id = Math.random().toString(36).substr(2, 9) + 'piklisteditor' + name.replace(/[^A-Z0-9]/g, '');
              
              $editor_wrap
                .css('height', $editor_wrap.height() + 'px')
                .empty();
              
              $.ajax({
                type : 'POST',
                url : ajaxurl,
                async: false,
                data: {
                  action: 'piklist_form',
                  method: 'field',
                  field: {
                    type: field.type,
                    field: field.field,
                    scope: field.scope,
                    options: field.options,
                    required: field.required,
                    prefix: field.prefix,
                    template: 'field',
                    embed: true,
                    id: id
                  }
                }
                ,success: function(response) 
                {
                  response = $.parseJSON(response);
                  
                  $(response.field).insertAfter($editor_wrap);
                
                  $editor_wrap.remove();
                
                  tinyMCEPreInit.mceInit[id] = tinyMCEPreInit.mceInit[original_id];
                  tinyMCEPreInit.mceInit[id].elements = id;
                
                  tinyMCEPreInit.qtInit[id] = tinyMCEPreInit.mceInit[original_id];
                  tinyMCEPreInit.qtInit[id].id = id;
                  
                  quicktags({
                    id: id
                  });
                          
                  tinyMCE.execCommand('mceAddControl', false, id);
                
                  var editor = tinyMCE.get(id);

                  editor.focus();
                }
              });
            }
            else
            {
              if (typeof tinyMCEPreInit.qtInit[id] == 'undefined')
              {
                for (original_id in tinyMCEPreInit.qtInit)
                {
                  if (original_id.substr(original_id.indexOf('piklisteditor') + ('piklisteditor').length) == id.substr(id.indexOf('piklisteditor') + ('piklisteditor').length))
                  {
                    tinyMCEPreInit.mceInit[id] = tinyMCEPreInit.mceInit[original_id];
                    tinyMCEPreInit.mceInit[id].elements = id;
            
                    tinyMCEPreInit.qtInit[id] = tinyMCEPreInit.mceInit[original_id];
                    tinyMCEPreInit.qtInit[id].id = id;
                    
                    break;
                  }
                }

                quicktags({
                  id: id
                });
                      
                tinyMCE.execCommand('mceAddControl', false, id);
              }
            }
          });
                    
        break;
        
        case 'datepicker':

          $(':input[name="' + field.name + '"]').each(function()
          {
            if (!$(this).hasClass('hasDatepicker'))
            {
              $(this)
                .attr('autocomplete', 'off')
                .datepicker(options);
            }
          });
      
        break;
        
        case 'colorpicker':
          
          $(':input[name="' + field.name + '"]').each(function()
          {
            $(this)
              .addClass('has-wp-color-picker')
              .wpColorPicker(options);
          });

        break;
      }
      
      if (field.js_callback)
      {
        window[field.js_callback](field);
      }
    },
    
    conditions_handler: function(event) 
    {
      var selector = event.data.selector,
        condition = event.data.condition,
        index = $(this).index(':input[name="' + $(this).attr('name') + '"]'),
        reset_selector = selector.replace(/\[[0-9]+(?!.*[0-9])\]/, '[' + index + ']'),
        field;
      
        if (selector == reset_selector)
      {
        field = $(selector + ':eq(' + index + ')');
        if (field.length == 0)
        {
          field = $(selector);
        }
      }
      else
      {
        field = $(reset_selector);
      }
      
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
        
          var options_page = $(this).parents('form').find(':input[name="option_page"]').length > 0,
            parent = options_page ? 'tr' : '.piklist-field-condition',
            element = $(this).prop('tagName') == 'LABEL' ? $(this).find(':input') : this,
            show = {
              'position': 'relative',
              'left': 'auto'
            },
            hide = {
              'position': 'absolute',
              'left': '-9999999px'
            };
        
          if ($(this).parents('div[data-piklist-field-group]').length > 0)
          {
            parent = 'div[data-piklist-field-group]';
          }
          else if ($(this).parents('div[data-piklist-field-columns]').length > 0)
          {
            parent = 'div[data-piklist-field-columns]';
          }
        
          if ($(element).val() == condition.value && !$(element).is(':checkbox'))
          {
            if (field.hasClass('piklist-field-condition'))
            {
              field.css(show);
            }
            else
            {
              field.parents(parent).css(show);
            }
          }
          else if ($(element).val() == condition.value && $(element).is(':checkbox') && $(element).is(':checked'))
          {
            if (field.hasClass('piklist-field-condition'))
            {
              field.css(show);
            }
            else
            {
              field.parents(parent).css(show);
            }
          }
          else
          {
            if (typeof condition.reset == 'undefined' || !condition.reset)
            {
              if (field.is(':radio') || field.is(':checkbox'))
              {
                field.attr('checked', false); 
              }
              else
              {
                field.val('');
              }
            }
          
            if ($(element).is(':input'))
            {
              if (field.hasClass('piklist-field-condition'))
              {
                field.css(hide);
              }
              else
              {
                field.parents(parent).css(hide);
              }
            }
          }
      
        break;
      }
    
      return false;
    }
  };
  
  $.fn.piklistfields = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();
  
    return this.each(function() 
    {
      var $this = $(this),
        data = $this.data('piklistfields'),
        options = typeof option === 'object' && option;
  
      if (!data) 
      {
        $this.data('piklistfields', (data = new PiklistFields(this, $.extend({}, $.fn.piklistfields.defaults, options, $(this).data()))));
      }
  
      if (typeof option === 'string') 
      {
        data[option].apply(data, _arguments);
      }
    });
  };
  
  $.fn.piklistfields.defaults = {};
  
  $.fn.piklistfields.Constructor = PiklistFields;
  
  
  
  
  
  
  
  
  
  
  
  /* --------------------------------------------------------------------------------
    Piklist Groups - Creates Group containers for Grouped Fields
  -------------------------------------------------------------------------------- */
  
  var PiklistGroups = function(element, options)
  {
    this.$element = $(element);

    this._init();
  };
  
  PiklistGroups.prototype = {

    constructor: PiklistGroups,

    _init: function() 
    {
      this.$element
        .find('*[data-piklist-field-group]:not(:radio, :checkbox)')
        .each(function()
        {
          var $element = $(this),
            group = $element.data('piklist-field-group'),
            sub_group = $element.data('piklist-field-sub-group');

          $element
            .siblings('label[for="' + $element.attr('name') + '"]:first, span.piklist-list-item-label')
            .addBack()
            .wrapAll('<div data-piklist-field-group="' + group + '" ' + (sub_group ? 'data-piklist-field-sub-group="' + sub_group + '"' : '') +' />');
         });
         
     this.$element
       .find('*[data-piklist-field-group]')
       .filter(':radio, :checkbox')
       .each(function()
       {
         var $element = $(this),
           group = $element.data('piklist-field-group'),
           sub_group = $element.data('piklist-field-sub-group'),
           list = $element.parents('.piklist-field-list').length > 0,
           parent_selector = list ? '.piklist-field-list' : '.piklist-field-list-item',
           parent = $element.parents('div[data-piklist-field-group]:eq(0)'),
           wrap = $('<div data-piklist-field-group="' + group + '" ' + (sub_group ? 'data-piklist-field-sub-group="' + sub_group + '"' : '') +' />');
           
         if (parent.length > 0)
         {
           parent.attr('data-piklist-field-group', group);
           
           if (sub_group)
           {
             parent.attr('data-piklist-field-sub-group', sub_group);
           }
         } 
         else
         {
           wrap.css('display', list ? 'block' : 'inline-block');
           
           $element
             .parents(parent_selector)
             .siblings('.piklist-label[for="' + $element.attr('name') + '"]:first')
             .addBack()
             .wrapAll(wrap);
         }
       });
    }
  };
  
  $.fn.piklistgroups = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();
  
    return this.each(function() 
    {
      var $this = $(this),
        data = $this.data('piklistgroups'),
        options = typeof option === 'object' && option;
  
      if (!data) 
      {
        $this.data('piklistgroups', (data = new PiklistGroups(this, $.extend({}, $.fn.piklistgroups.defaults, options, $(this).data()))));
      }
  
      if (typeof option === 'string') 
      {
        data[option].apply(data, _arguments);
      }
    });
  };
  
  $.fn.piklistgroups.defaults = {};
  
  $.fn.piklistgroups.Constructor = PiklistGroups;
  
  
  
  
  
  
  
  
  
  
  
  /* --------------------------------------------------------------------------------
    Piklist Add More - Creates Add More fields for Piklist
  -------------------------------------------------------------------------------- */
  
  var PiklistAddMore = function(element, options)
  {
    this.$element = $(element);
    
    this.add = options.add;
    this.remove = options.remove;
    this.move = options.move;
    this.sortable = options.sortable;
    
    this._init();
  };
  
  PiklistAddMore.prototype = {

    constructor: PiklistAddMore,
    
    templates: [],

    _init: function() 
    {
      var $this = this;
      
      $(document).on('click', '[data-piklist-field-addmore-action]', { piklistaddmore: $this }, $this.action_handler);
      
      this.$element
        .find('*[data-piklist-field-addmore="true"]')
        .each(function()
        {
          var $element = $(this),
            group = $element.attr('data-piklist-field-group'),
            set = $element.attr('name'),
            $wrapper = $('<div />')
                         .attr('data-piklist-field-addmore', set)
                         .addClass('piklist-field-addmore-wrapper'),
            $wrapper_actions = $('<div />')
                                  .addClass('piklist-field-addmore-wrapper-actions')
                                  .css('display', 'inline');
      
          if ($element.is('[data-piklist-field-columns]'))
          {
            $wrapper.css({
              'float': 'none'
            });
          }
      
          if ($element.is(':checkbox, :radio'))
          {
            var $parent = $(':input[name="' + $element.attr('name') + '"]').commonAncestor();

            if ($parent.parent('div[data-piklist-field-addmore="' + $element.attr('name') + '"]').length == 0)
            {
              $parent.wrapAll($wrapper);
            }
          }
          else
          {
            if ($element.hasClass('wp-editor-area'))
            {
              $wrapper.addClass('piklist-field-addmore-wrapper-full');

              $element
                .parents('.wp-editor-wrap:first')
                .wrapAll($wrapper);
            }
            else if (typeof group === 'undefined')
            {
              $element
                .siblings('label[for="' + $element.attr('name') + '"], .piklist-field-preview, .piklist-label-container')
                .addBack()
                .wrapAll($wrapper);
            }
            else
            {
              var set = $('div[data-piklist-field-group="' + group + '"], div[data-piklist-field-sub-group="' + group + '"]');

              $element = set.last();

              set = $.merge(set, $(set.last()));

              set.wrapAll($wrapper);
            }
          }

          var $container = $element.parents('div[data-piklist-field-addmore' + (typeof set == 'string' ? '="' + set + '"' : '') + ']:first'),
            $parent = $container.parent();
             
          if ($container.find('[data-piklist-field-addmore-actions="false"]').length == 0)
          { 
            if ($container.height() >= 70)
            {
              $wrapper_actions.addClass('piklist-field-addmore-wrapper-actions-vertical');
              $container.addClass('piklist-field-addmore-wrapper-vertical');
            }
          
            $wrapper_actions.prepend($($this.add).attr('data-piklist-field-addmore-action', 'add'));
            $wrapper_actions.prepend($($this.remove).attr('data-piklist-field-addmore-action', 'remove'));
          }
          else
          {
            $container.addClass('piklist-field-sortable');
          }
          
          if ($this.sortable)
          {
            if (!$parent.hasClass('ui-sortable'))
            {
              $parent  
                .sortable({
                  items: '> div[data-piklist-field-addmore]',
                  cursor: 'move',
                  start: function(event, ui)
                  {
                    $(this).find('.wp-editor-area').each(function()
                    {
                      if (typeof switchEditors != 'undefined')
                      {
                        var id = $(this).attr('id');
                      
                        switchEditors.go(id, 'tmce')
          
                        tinyMCE.execCommand('mceRemoveControl', false, id);
                      }
                    });
                  },
                  stop: function(event, ui) 
                  {
                    $(this).find('.wp-editor-area').each(function()
                    {
                      if (typeof switchEditors != 'undefined')
                      {
                        var id = $(this).attr('id');
                      
                        tinyMCE.execCommand('mceAddControl', true, id);
                      }
                    });
                  }
                });
            }
          }

          var $element_last = $element
                                .parent('div.piklist-field-addmore-wrapper')
                                .children('div[data-piklist-field-group="' + group + '"]:last');

          if ($element_last.length > 0)
          {
            $wrapper_actions.insertAfter($element_last);
          }
          else
          {
            if ($element.hasClass('wp-editor-area'))
            {
              $element = $element.parents('.wp-editor-wrap:first');
            }

            $wrapper_actions.insertAfter($element);
          }
        });
        
      this.$element
        .find(':input[data-piklist-field-addmore]')
        .each(function()
        {
          var $element = $(this),
            $html = $element.parents('div[data-piklist-field-addmore]:first'),
            name = $html.attr('data-piklist-field-addmore'),
            names = [],
            excludes = '[data-piklist-field-addmore], .piklist-field-addmore-wrapper-actions, .piklist-field-addmore-wrapper, .piklist-field-column';
          
          if (typeof name != 'undefined')
          {
            $html = $('<div/>').append($html.parent().html());
            
            $html.find('div[data-piklist-field-addmore]').each(function()
            {
              var data = $(this).attr('data-piklist-field-addmore');
            
              if ($.inArray(data, names) == -1)
              {
                $(this).find(':input').each(function()
                {
                  $(this)
                    .attr('data-piklist-original-id', $(this).attr('id'))
                    .removeAttr('id')
                    .removeAttr('checked')
                    .off()
                    .find('option')
                    .removeAttr('selected');
                    
                  if (!$(this).is(':checkbox, :radio'))
                  {
                    $(this).removeAttr('value');
                  }
                });
                
                if (!$(this).prev().is(excludes))
                {
                  $(this).prev().remove();
                }

                if (!$(this).next().is(excludes))
                {
                  $(this).next().remove();
                }

                $(this)
                  .find('.piklist-field-preview')
                  .remove();
                  
                if ($(this).children('*:nth-last-child(2)').height() < 45 && $(this).children('div[data-piklist-field-addmore]').length == 0 && $(this).children().length < 5)
                {
                  $(this)
                    .removeClass('piklist-field-addmore-wrapper-vertical')
                    .find('.piklist-field-addmore-wrapper-actions-vertical')
                    .removeClass('piklist-field-addmore-wrapper-actions-vertical');
                }
                
                names.push(data);
              }
              else
              {
                $(this).remove();
              }
            });
            
            
            $html.children().each(function()
            {
              if (!$(this).is('.piklist-field-addmore-wrapper-actions, [data-piklist-field-addmore="' + name + '"]'))
              {
                $(this).remove();
              }
            });

            $this.templates[name] = $html.html();
          }
        });
    },
    
    action_handler: function(event)
    {
      event.preventDefault();
      
      if (event.isPropagationStopped())
      {
        return; 
      }
      
      event.stopPropagation();
      
      var $element = $(this),
        $wrapper = $element.parents('div.piklist-field-addmore-wrapper:first'),
        count = $wrapper.siblings('div.piklist-field-addmore-wrapper').length,
        element = $wrapper.attr('data-piklist-field-addmore'),
        element_indexes = element ? element.replace(/\]/g, '').split('[') : [],
        groups = 0,
        $this = event.data.piklistaddmore;
        
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
          
          var name = $wrapper.attr('data-piklist-field-addmore'),
            template = $this.templates[name],
            sub_group = $(template).find('div[data-piklist-field-addmore="' + name + '"]:first');
          
          if (sub_group.length > 0)
          {
            template = $(sub_group).clone().wrap('<div>').parent().html();
          }
          
          $(template).insertAfter($wrapper);

          $wrapper
            .parent()
            .children('div.piklist-field-addmore-wrapper')
            .each(function(i)
            {
              $(this).find(':input').each(function()
              {
                var name = $(this).attr('name'),
                  widgets = $(this).parents('.widget-content').length > 0;
                
                if (name)
                {
                  var indexes = name.replace(/\]/g, '').split('['),
                    scope = indexes[0],
                    parent = $(this).parents('div[data-piklist-field-addmore]:last'),
                    index = parent.index('div[data-piklist-field-addmore="' + parent.attr('data-piklist-field-addmore') + '"]');
                    
                  for (var j = 0; j < indexes.length; j++)
                  {
                    if ($.isNumeric(indexes[j]))
                    {
                      if (!widgets)
                      {
                        indexes[j] = index;
                      }
                        
                      widgets = false;
                    }
                    
                    indexes[j] = indexes[j] + (scope !== indexes[j] ? ']' : '');
                  }
                  
                  $(this).attr('name', indexes.join('['));
                
                  $('*[for="' + name + '"]').attr('for', indexes.join('['));
                }
              });

              $(this)
                .sortable({
                  items: '> div[data-piklist-field-addmore]',
                  cursor: 'move',
                  start: function(event, ui)
                  {
                    $(this).find('.wp-editor-area').each(function()
                    {
                      if (typeof switchEditors != 'undefined')
                      {
                        var id = $(this).attr('id');
                    
                        switchEditors.go(id, 'tmce')
        
                        tinyMCE.execCommand('mceRemoveControl', false, id);
                      }
                    });
                  },
                  stop: function(event, ui) 
                  {
                    $(this).find('.wp-editor-area').each(function()
                    {
                      if (typeof switchEditors != 'undefined')
                      {
                        var id = $(this).attr('id');
                    
                        tinyMCE.execCommand('mceAddControl', true, id);
                      }
                    });
                  }
                });
            })
            .piklistfields();

        break;
        
        case 'remove':
          
          if (count > 0)
          {
            $wrapper.remove();
          }
          
        break;
      }
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
    this.column_width = options.column_width;
    this.gutter_width = options.gutter_width;
    this.gutter_height = options.gutter_height;
    this.minimum_height = options.minimum_height;
    
    this._init();
  };
  
  PiklistColumns.prototype = {

    constructor: PiklistColumns,

    _init: function() 
    {
      var total_columns = this.total_columns,
        column_width = this.column_width,
        gutter_width = this.gutter_width,
        gutter_height = this.gutter_height,
        minimum_height = this.minimum_height,
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
            columns = $element.data('piklist-field-columns'),
            parent = $element.parent('div[data-piklist-field-group]:eq(0)');
            
          if (parent.length > 0)
          {
            parent.attr('data-piklist-field-columns', columns);
          } 
          else
          {
            $element
              .siblings('label[for="' + $element.attr('name') + '"]:first')
              .addBack()
              .wrapAll('<div data-piklist-field-columns="' + columns + '" />');
          }
        
          $element
            .css({
              'width': $element.attr('size') || $element.is(':button, :submit') ? 'auto' : '100%',
            })
            .parent('div[data-piklist-field-columns]')
            .css({
              'display': 'block',
              'float': 'left',
              'width': (columns * column_width + (columns - 1) * gutter_width) + '%',
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
            columns = $element.data('piklist-field-columns'),
            group = $element.data('piklist-field-group'),
            sub_group = $element.data('piklist-field-sub-group'),
            parent_selector = $element.parents('.piklist-field-list').length > 0 ? '.piklist-field-list' : '.piklist-field-list-item';
            
          $element
            .parents(parent_selector)
            .each(function()
            {
              if ($(this).parent('div[data-piklist-field-columns]').length == 0)
              {
                var parent = $(this).parent('div[data-piklist-field-group]:eq(0)');
                
                if (parent.length > 0)
                {
                  parent.attr('data-piklist-field-columns', columns);
                } 
                else
                {
                  $(this)
                    .siblings('.piklist-label[for="' + $element.attr('name') + '"]:first')
                    .addBack()
                    .wrapAll('<div data-piklist-field-columns="' + columns + '" data-piklist-field-group="' + group + '" ' + (sub_group ? 'data-piklist-field-sub-group="' + sub_group + '"' : '') +' />');
                }
                
                $(this)
                  .parent('div[data-piklist-field-columns]')
                  .css({
                    'display': 'block',
                    'float': 'left',
                    'width': (columns * column_width + (columns - 1) * gutter_width) + '%',
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
              columns = $element.data('piklist-field-columns'),
              group = $element.data('piklist-field-group');

            $element.addClass('piklist-field-column');
            
            if (typeof track.group == 'undefined' || track.group != group)
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
          .each(function()
          {
            var row = $(this).nextUntil('.piklist-field-column-last').addBack(),
              columns = row.add(row.last().next()),
              height = 0;
              
              columns.each(function(i)
              {
                if ($(this).height() > height)
                {
                  height = $(this).height();
                }
              });

              columns.css('min-height', height);
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
    column_width: 6,
    gutter_width: 2.54,
    gutter_height: '7px',
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
        });
          
      $('.piklist-upload-file-preview .attachment').on('click', function(event)
      {
        event.preventDefault();
      
        $(this)
          .parents('.piklist-upload-file-preview:first')
          .prev('.piklist-upload-file-button')
          .trigger('click');
      });
      
      $('.piklist-upload-file-preview .attachment .check').on('click', function(event)
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
      
      $('.piklist-upload-file-button').on('click', function(event)
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
            input = button.next('.piklist-upload-file-preview').children(':input[type="hidden"]'),
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


jQuery.fn.reverse = function() 
{
  return Array.prototype.reverse.call(this);
};

jQuery.fn.commonAncestor = function() 
{
  var current = null,
    compare = this.eq(0).parents().reverse(),
    position = compare.length - 1;

  for (var i = 1, j = this.length; i < j && position > 0; i += 1) 
  {
    current = this.eq(i).parents().reverse();
    position = Math.min(position, current.length - 1);

    while (compare[position] !== current[position]) 
    {
      position -= 1;
    }
  }
  
  return compare.eq(position);
};