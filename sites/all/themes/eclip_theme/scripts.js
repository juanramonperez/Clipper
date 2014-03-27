/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($){
    Drupal.behaviors.eclip = {
        attach: function(context, settings) {
            $('.view-front-get-news .view-content, .category-content').once('view-more', function(key, category){
                var totalHeight = 0;
                $(category).find('.news-item, .noticia').each(function(key, noticia){
                    //console.log($(noticia).outerHeight(true));                    
                    if(key == $('.node-clip').data('limit')){
                        $(category).height(totalHeight).css('overflow', 'hidden').attr('max', totalHeight);
                        $(category).parent()
                            .append('<a class="vermas collapsed" href="#">[Ver más]</a>')
                            .find('.vermas').click(function(e){
                                e.preventDefault();
                                if($(this).hasClass('collapsed')){
                                    $(this).html('[Ver menos]');
                                    $(this).removeClass('collapsed').addClass('expanded');
                                    $(this).parent().find('.view-content, .category-content').css('height', 'auto');
                                }else{
                                    $(this).html('[Ver más]');
                                    $(this).addClass('collapsed').removeClass('expanded');
                                    $(this).parent().find('.view-content, .category-content').css('height', $(this).parent().find('.view-content, .category-content').attr('max'));
                                }
                        });
                    }
                    totalHeight += $(noticia).outerHeight(true);
                })
            });
            
            $('.toggle-related-items').once('view-related', function(key, related){
                $(related).click(function(e){
                    e.preventDefault();
                    $('.related-items[article=' + $(related).attr('article') + ']').toggle();
                })
                
            });            
        }
    }    
})(jQuery);
