/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    Drupal.behaviors.eclip = {
        attach: function(context, settings) {
            $('div.portlet').once('group', function(){
              $(this).find('.news-item.group-1').wrapAll('<div class="news-content news-group"></div>');
              $(this).find('.news-item.group-2').wrapAll('<div class="news-content news-group"></div>');
              $(this).find('.news-item.group-3').wrapAll('<div class="news-content news-group"></div>');
              $(this).find('.news-item.group-4').wrapAll('<div class="news-content news-group"></div>');
              $(this).find('div.news-group').prepend('<span class="close-group ui-icon ui-icon-circle-close"></span> ');
            });
       
            $('.portlet-header .ui-icon', context).once('eclip', function () {
                $(this).click(function() {
                    $( this ).toggleClass('ui-icon-minusthick').toggleClass('ui-icon-plusthick');
                    $( this ).parents('.portlet:first').find('.portlet-content').toggle();
                });
            });         
      
            $('.news-actions .ui-icon-circle-close').once('eclip', function () {
                $(this).click(function() {         
                    $(this).parents('.news-item:first').each(function(){
                        if($(this).hasClass('status-0')){
                            $(this).removeClass('status-0');
                            $(this).addClass('status-1');
                        }else if($(this).hasClass('status-1')){
                            $(this).removeClass('status-1');
                            $(this).addClass('status-0');
                        }
                    });
                });
            });
            
            $('.news-actions .ui-vote', context).once('eclip', function () {
                $(this).click(function() {
                    $(this).parents('.news-item:first').each(function(){
                        if($(this).hasClass('vote-0')){
                            $(this).removeClass('vote-0');
                            $(this).addClass('vote-1');
                        } else if($(this).hasClass('vote-1')){
                            $(this).removeClass('vote-1');
                            $(this).addClass('vote-2');
                        }else if($(this).hasClass('vote-2')){
                            $(this).removeClass('vote-2');
                            $(this).addClass('vote-3');
                        }else if($(this).hasClass('vote-3')){
                            $(this).removeClass('vote-3');
                            $(this).addClass('vote-0');
                        }
                    });
                });
            });
            
            $('.close-group', context).once('eclip', function () {
                $(this).click(function() {
                    $(this).parent().find('.news-item').appendTo($(this).parent().parent());
                    $(this).parent().remove();           
                });
            });               
      
            $('.clipper-placeholder').each(function () {
                $(this).sortable({
                    connectWith: '.clipper-placeholder',
                    items: 'div.portlet'
                });
            });
      
            $('.news-content').each(function(){
                $(this).sortable({
                    connectWith: '.news-content',                  
                    items: 'div.news-item, div.news-group'
                    
                });
                $(this).disableSelection();
            });
      
            $('#edit-save, #edit-send').click(function(){
                var zone;    
                var zoneId;
                var category;
                var categoryId;
                var noticiaId;
                var noticia;
                var status;
                var vote;
                var clip = {
                    categories: [],
                    news: [],
                    highlighted: []
                };
                $('div.clipper-placeholder').each(function(){
                    zone    = $(this);    
                    zoneId  = getId('zone', zone.attr('class'));                    
                    zone.find('div.portlet').each(function(key, value){
                        $(this).find('.news-group').each(function(key, value){
                          id = key + 1;
                          $(this).addClass('group-' + id);
                        });
                        category    = $(this);
                        categoryId  = getId('category', category.attr('class'));
                        priority    = category.find('input.spinner').val();                        
                        clip.categories.push([parseInt(zoneId), parseInt(categoryId), key, parseInt(priority)]); 
                        category.find('div.news-item').each(function(key, value){
                            groupId   = 0;
                            noticia   = $(this);
                            noticiaId = getId('new', noticia.attr('class'));
                            status    = getId('status', noticia.attr('class'));
                            vote      = getId('vote', noticia.attr('class'));
                            noticia.parents('.news-group:first').each(function(){
                              groupId   = getId('group', $(this).attr('class'));
                            });                            
                            clip.news.push([parseInt(categoryId), parseInt(noticiaId), key, parseInt(status), parseInt(vote), parseInt(groupId)]);           
                        });
                    });          
                });
                $('.zone-destacado').each(function(){
                    var destacado = $(this);
                    destacado.find('div.news-item').each(function(key, value){
                        noticia   = $(this);
                        noticiaId = getId('new', noticia.attr('class'));
                        status    = getId('status', noticia.attr('class'));
                        vote      = getId('vote', noticia.attr('class'));                        
                        clip.highlighted.push([parseInt(noticiaId), key, parseInt(status), parseInt(vote)]);
                    });
                });
                $('#positions').val(serialize(clip));
                //console.log(clip);
            });
            /*
       * 
       */
            function getId(base, strClasses){
                var id      = 0;
                var classes = strClasses.split(' ');
                $.each(classes, function(key, value){
                    if(value.search(base + '-') != -1){
                        var aux = value.split('-');
                        id = aux[1];            
                    };
                });
                return id;
            } 
        }
    }
})(jQuery);

function serialize (mixed_value) {
    // http://kevin.vanzonneveld.net
    // +   original by: Arpad Ray (mailto:arpad@php.net)
    // +   improved by: Dino
    // +   bugfixed by: Andrej Pavlovic
    // +   bugfixed by: Garagoth
    // +      input by: DtTvB (http://dt.in.th/2008-09-16.string-length-in-bytes.html)
    // +   bugfixed by: Russell Walker (http://www.nbill.co.uk/)
    // +   bugfixed by: Jamie Beck (http://www.terabit.ca/)
    // +      input by: Martin (http://www.erlenwiese.de/)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net/)
    // +   improved by: Le Torbi (http://www.letorbi.de/)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net/)
    // +   bugfixed by: Ben (http://benblume.co.uk/)
    // %          note: We feel the main purpose of this function should be to ease the transport of data between php & js
    // %          note: Aiming for PHP-compatibility, we have to translate objects to arrays
    // *     example 1: serialize(['Kevin', 'van', 'Zonneveld']);
    // *     returns 1: 'a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}'
    // *     example 2: serialize({firstName: 'Kevin', midName: 'van', surName: 'Zonneveld'});
    // *     returns 2: 'a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}'
    var val, key, okey,
    ktype = '', vals = '', count = 0,
    _utf8Size = function (str) {
        var size = 0,
        i = 0,
        l = str.length,
        code = '';
        for (i = 0; i < l; i++) {
            code = str.charCodeAt(i);
            if (code < 0x0080) {
                size += 1;
            }
            else if (code < 0x0800) {
                size += 2;
            }
            else {
                size += 3;
            }
        }
        return size;
    },
    _getType = function (inp) {
        var match, key, cons, types, type = typeof inp;

        if (type === 'object' && !inp) {
            return 'null';
        }
        if (type === 'object') {
            if (!inp.constructor) {
                return 'object';
            }
            cons = inp.constructor.toString();
            match = cons.match(/(\w+)\(/);
            if (match) {
                cons = match[1].toLowerCase();
            }
            types = ['boolean', 'number', 'string', 'array'];
            for (key in types) {
                if (cons == types[key]) {
                    type = types[key];
                    break;
                }
            }
        }
        return type;
    },
    type = _getType(mixed_value)
    ;

    switch (type) {
        case 'function':
            val = '';
            break;
        case 'boolean':
            val = 'b:' + (mixed_value ? '1' : '0');
            break;
        case 'number':
            val = (Math.round(mixed_value) == mixed_value ? 'i' : 'd') + ':' + mixed_value;
            break;
        case 'string':
            val = 's:' + _utf8Size(mixed_value) + ':"' + mixed_value + '"';
            break;
        case 'array': case 'object':
            val = 'a';
            /*
            if (type == 'object') {
            var objname = mixed_value.constructor.toString().match(/(\w+)\(\)/);
            if (objname == undefined) {
                return;
            }
            objname[1] = this.serialize(objname[1]);
            val = 'O' + objname[1].substring(1, objname[1].length - 1);
            }
            */

            for (key in mixed_value) {
                if (mixed_value.hasOwnProperty(key)) {
                    ktype = _getType(mixed_value[key]);
                    if (ktype === 'function') {
                        continue;
                    }

                    okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
                    vals += this.serialize(okey) + this.serialize(mixed_value[key]);
                    count++;
                }
            }
            val += ':' + count + ':{' + vals + '}';
            break;
        case 'undefined':
        // Fall-through
        default:
            // if the JS object has a property which contains a null value, the string cannot be unserialized by PHP
            val = 'N';
            break;
    }
    if (type !== 'object' && type !== 'array') {
        val += ';';
    }
    return val;
}     
