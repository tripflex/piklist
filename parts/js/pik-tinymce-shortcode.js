
(function($) 
{
  tinymce.create('tinymce.plugins.PiklistShortcodePlugin', {
    init: function(ed, url) 
    {
      var base = url.split('/wp-content');
      
      ed.addCommand('PiklistShortcode', function() 
      {
        tb_show('Widgets', base[0] + '/wp-admin/widgets.php?piklist[admin_hide_ui]=true&TB_iframe=true');
        
        var width = Math.round($(window).width() * 0.90);
        $('#TB_window')
          .css({
            'width': width
            ,'margin-left': -width / 2
          })
          .find('iframe')
            .css({
              'width': '100%'
            });
      });
    
      ed.addButton('piklist_shortcode', {
        title: 'piklist_shortcode'
        ,cmd: 'PiklistShortcode'
        ,image: base[0] + '/wp-admin/images/press-this.png'
      });
    }
 
    ,getInfo: function() 
    {
      return {
        longname: 'Widget Shortcode'
        ,author: 'Piklist'
        ,authorurl: 'http://piklist.com'
        ,infourl: 'http://piklist.com'
        ,version: tinymce.majorVersion + '.' + tinymce.minorVersion
      };
    }
  });
 
  tinymce.PluginManager.add('piklist_shortcode', tinymce.plugins.PiklistShortcodePlugin);

})(jQuery);