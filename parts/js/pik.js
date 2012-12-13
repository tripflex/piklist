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
        
        piklist.add_more_fields();
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
        
        piklist.field_columns();
        piklist.add_more_elements();
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
                var increment = _field.id.substr(_field.id.lastIndexOf('_') + 1);
                _field.id = !isNaN(parseFloat(increment)) && isFinite(increment) ? _field.id.substr(0, _field.id.lastIndexOf('_')) : _field.id;
              
                $(document).delegate('.' + _field.id, 'change', piklist.conditions_handler(field.conditions[i].id, field.conditions[i]));
                $(':input:not(:radio)[class~="' + _field.id + '"], :radio:checked[class~="' + _field.id + '"]').trigger('change');

                piklist.processed_conditions[field.conditions[i].type].push(field.conditions[i].id);
                              
              break;
            
              default:
                
                if ($.inArray(field.conditions[i].id, piklist.processed_conditions[field.conditions[i].type]) == -1)
                {
                  $(document).delegate('.' + field.conditions[i].id, 'change', piklist.conditions_handler(field.id, field.conditions[i]));
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
          
          case 'timepicker':
                    
            $('#' + field.id)
              .val($('#' + field.id).val() ? $('#' + field.id).val() : (!field.value ? null : field.value))
              .attr('autocomplete', 'off')
              .timePicker(options);
            
            $('.time-picker').addClass('ui-corner-all ui-widget');
                    
          break;
          
          case 'colorpicker':
            
            if ($('#' + field.id).next('.piklist-colorpicker').length == 0)
            {
              $('#' + field.id).removeAttr('style');
              
              $($('<div />')
                  .addClass('piklist-colorpicker')
                  .addClass('piklist-remove-add-more')
                  .hide()
                  .farbtastic($('#' + field.id), options)
              ).insertAfter('#' + field.id);

              $('#' + field.id)
                .val($('#' + field.id).val() ? $('#' + field.id).val() : '#ffffff')
                .attr('autocomplete', 'off')
                .focus(function()
                {
                  $(this).next('.piklist-colorpicker').show('slow');
                })
                .blur(function()
                {
                  $(this).next('.piklist-colorpicker').hide('slow');
                });
            }

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
              
              if ($(this).val() == condition.value || condition.force)
              {
                if (field.length == 0)
                {
                  field = $('.' + id + '[value="' + condition.value + '"]');
                }
                
                if (field.is(':radio') || field.is(':checkbox'))
                {
                  var increment = $(this).attr('id').substr($(this).attr('id').lastIndexOf('_') + 1);
                  var actual_id = !isNaN(parseFloat(increment)) && isFinite(increment) ? $(this).attr('id').substr(0, $(this).attr('id').lastIndexOf('_')) : $(this).attr('id');
                  
                  field.attr('checked', $('.' + actual_id + ':checked').length > 0 ? true : false);
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
                field.parents(parent).show('slow');
              }
              else if ($(element).val() == condition.value && $(element).is(':checkbox') && $(element).is(':checked'))
              {
                field.parents(parent).show('slow');
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
                  field.parents(parent).hide('slow');
                }
              }
            
            break;
          }
        };
      },
          
      add_more_interval: null,
      add_more_active: null,
      add_more_remove_classes: [
        'hasDatepicker'
      ],
      
      add_more_fields: function()
      {
        $('body').append(
          $('<div id="piklist-field-add-more">')
            .hide()
            .css({
              'position': 'absolute'
              ,'z-index': 99999
            })
            .hover(
              function()
              {
                $(this).addClass('piklist-field-add-more-active');
              }
              ,function()
              {
                $(this).removeClass('piklist-field-add-more-active');
              }
            )
            .append(
              $('<a href="#" id="piklist-field-add-more-add-button" class="button-primary">+</a>')
                .css({
                  'margin-right': '.5em'
                })
                .click(function(event)
                {
                  event.preventDefault();

                  $('#piklist-field-add-more').hide();
                              
                  piklist.add_more_active.find(':input').each(function()
                  {
                    if ($(this).attr('name').indexOf('[]') == -1)
                    {
                      $(this).attr('name', $(this).attr('name') + '[]');
                    }
                  });
                  
                  var form_id = piklist.add_more_active.parents('form').find(':input[class="piklist_fields_id"]').val();
                  var fields = piklist.to_array(piklist_fields[form_id]);
                  var clone = piklist.add_more_active.clone();
                  var clone_inputs = clone.find(':input');
                  var input = null;
                  var new_fields = new_inputs = [];                  
                  
                  clone.removeClass('piklist-add-more-activated');
                  clone.find('.piklist-remove-add-more').remove();
                  
                  for (var c = 0; c < clone_inputs.length; c++)
                  {                
                    input = $(clone_inputs[c]);
                      
                    input.val('');
                    
                    var replace = piklist.add_more_remove_classes;
                    
                    for (var h = 0; h < replace.length; h++)
                    {
                      input.removeClass(replace[h]);
                    }
                                        
                    replace = [
                      {
                        attr: 'id'
                        ,sep: '_'
                      }
                      ,{
                        attr: 'name'
                        ,sep: '['
                      }
                      ,{
                        attr: 'class'
                        ,sep: '_'
                      }
                    ];
                    
                    for (var h = 0; h < replace.length; h++)
                    {
                      var p = input.attr(replace[h].attr).split(replace[h].sep);
                      var numeric = false;
                  
                      for (var i = 0; i < p.length; i++)
                      {
                        p[i] = p[i].replace(']', '');
                        if (!isNaN(parseFloat(p[i])) && isFinite(p[i]))
                        {
                          p[i] = (parseInt(p[i]) + 1).toString();
                          numeric = true;
                        }
                        else
                        {
                          var t = p[i].split(' ');
                          
                          if (t.length > 1)
                          {
                            for (var k = 0; k < t.length; k++)
                            {
                              if (!isNaN(parseFloat(t[k])) && isFinite(t[k]))
                              {
                                t[k] = (parseInt(t[k]) + 1).toString();
                                numeric = true;
                              }
                            }
                            p[i] = t.join(' ');
                          }
                        }
                      }
                  
                      switch (replace[h].attr)
                      {  
                        case 'id':
                    
                          input.attr(replace[h].attr, !numeric ? input.attr(replace[h].attr) + replace[h].sep + '1' : p.join(replace[h].sep));
                          
                          if (!numeric)
                          {
                            piklist.add_more_active.attr(replace[h].attr, piklist.add_more_active.attr(replace[h].attr) + replace[h].sep + '0');
                          }
                          
                        break;
                        
                        case 'class':
                    
                          input.attr(replace[h].attr, p.join(replace[h].sep));
                    
                        break;
                      
                        case 'name':
                  
                          if (piklist.add_more_active.parents('.widget-content').length == 0)
                          {
                            var name = '';
                          
                            for (var j = 0; j < p.length; j++)
                            {
                              name += p[j] + (j < p.length - 1 ? (j == 0 ? '[' : '][') : '');
                            }
                          
                            name += ']';
                            
                            var matches = name.match(/\[(\d+)\]/);
                  
                            input.attr(replace[h].attr, numeric && matches === null ? name.substr(0, name.length - 2) : name);
                                       
                            for (var i in fields)
                            {
                              for (var j in fields[i])
                              {
                                if (fields[i][j].id == piklist.add_more_active.find(':input:eq(' + c + ')').attr('id'))
                                {
                                  fields[i].push(fields[i][j]);
                  
                                  fields[i][fields[i].length - 1].id = input.attr('id');
                                  fields[i][fields[i].length - 1].name = input.attr('name');
                  
                                  new_fields.push(fields[i][fields[i].length - 1]);
                                }
                              }
                            }
                          }
                          else
                          {
                            var name = input.attr(replace[h].attr);
                            if (name.substr(name.length - 2) != '[]')
                            {
                              input.attr(replace[h].attr, name + '[]');
                            }
                          }
                          
                        break;
                      }
                    }
                  }

                  piklist.add_more_handler(clone);
                  
                  piklist.add_more_active.after(clone);
                  
                  for (var n = 0; n < new_fields.length; n++)
                  {
                    piklist.process_field(new_fields[n], form_id);
                  }
                })
            )
            .append(
              $('<a href="#" id="piklist-field-add-more-remove-button" class="button">-</a>')
                .click(function(event)
                {
                  event.preventDefault();

                  $('#piklist-field-add-more').hide();

                  piklist.add_more_active.remove();
                })
            )
        );
      },

      add_more_elements: function()
      {
        $('.piklist-field-add-more:not(.piklist-add-more-activated)').each(function()
        {
          var element = $(this).find(':input:first');
          if (element.length > 0 && element.attr('name').indexOf('__i__') <= 0)
          {
            piklist.add_more_handler(this);
          }
        });
      },
      
      add_more_handler: function(object)
      {
        $(object)
           .css({
             'margin-bottom': '.5em'
             ,'display': 'block'
           })
           .addClass('piklist-add-more-activated')
           .hover(
             function()
             {
               piklist.add_more_active = $(this);
             
               var last = $(this).find(':input:last');
               var o = last.offset();

               var n = $(this).parent().find('.piklist-field-add-more');
               if (n.index(this) == n.length - 1)
               {
                 $('#piklist-field-add-more-add-button').show();
               }
               else
               {
                 $('#piklist-field-add-more-add-button').hide();
               }

               if ($(this).siblings('.piklist-field-add-more').length > 0)
               {
                 $('#piklist-field-add-more-remove-button').show();
               }
               else
               {
                 $('#piklist-field-add-more-remove-button').hide();
               }

               $('#piklist-field-add-more')
                 .css({
                   'top': (o.top + parseFloat(last.css('margin-top')) + parseFloat(last.css('border-top-width'))) + 'px'
                   ,'left': (o.left + last.outerWidth() + 10) + 'px'
                 })
                 .addClass('piklist-field-add-more-active')
                 .show();
             }
             ,function()
             {
               $('#piklist-field-add-more')
                 .removeClass('piklist-field-add-more-active');
            
               piklist.add_more_interval = setInterval(function()
               {
                 if (!$('#piklist-field-add-more').hasClass('piklist-field-add-more-active'))
                 {
                   $('#piklist-field-add-more')
                     .removeClass('piklist-field-add-more-active')
                     .hide();

                   clearInterval(piklist.add_more_interval);
                 }
               }, 500);
             }
           );
      },
      
      field_columns: function()
      {
        $('*[class*="piklist-field-column-"]:not(:radio, :checkbox)').each(function()
        {
          var tag = $(this)[0].nodeName.toLowerCase();
          var classes = $(this).attr('class').split(' ');
          for (var i = 0; i < classes.length; i++)
          {
            if (classes[i].indexOf('piklist-field-column-') > -1)
            {
              var columns = parseFloat(classes[i].replace('piklist-field-column-', ''));
            }
          }
          
          $(this).css({
            'display': 'block'
            ,'float': tag == 'input' || tag == 'select' || tag == 'textarea' ? 'none' : 'left'
            ,'width': ((columns / 12) * 100) - 2.5 + '%'
            ,'margin-right': 2.5 + '%'
          });

          $(this).find(':input:not(:radio, :checkbox)').each(function()
          {
            $(this).css({
              'width': '100%'
            });
          })
          
          if ($(this).siblings('.piklist-column-clear').length == 0)
          {
            $(this).parent().append(
              $('<span/>')
                .addClass('piklist-column-clear')
                .css({
                  'clear': 'both'
                  ,'display': 'block'
                  ,'visibility': 'hidden'
                })
            );
          }          
        });
      }
    
    };
  
  })(jQuery);
