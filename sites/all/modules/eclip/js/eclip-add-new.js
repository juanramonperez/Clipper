/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    Drupal.behaviors.eclipAddNew = {
        attach: function(context, settings) {

            $('.view-helper-agregar-noticia .add-new').once('eclip', function () {
                var $this  = $(this);
                $this.click(function(e){
                    e.preventDefault();
                    if(!$this.hasClass('added')){
                        var markup = '<div class="news-item new-' + $this.data('nid') + ' status-1 vote-1 image-1">'
                            + '<span class="ui-icon ui-icon-arrowthick-2-n-s"></span><span class="news-title">' + $this.data('title')
                            + '<span class="news-medio">' + $this.data('medio') + '</span>'
                            + '</span><span class="news-actions"><span class="ui-icon ui-image"></span><span class="ui-icon ui-vote"></span><a href="' + Drupal.settings.basePath + 'adm/news/' + $this.data('nid') + '/view">'
                            + '<span class="ui-icon ui-icon-circle-zoomin"></span></a><span class="ui-icon ui-icon-circle-close"></span></span></div>';
                        $(parent.document).find('.category-' + $this.data('tid') + ' .news-content .view-content').append(markup);
                        Drupal.attachBehaviors($(parent.document).find('.category-' + $this.data('tid') + ' .news-content .view-content'));
                        $this.html('<span class="ui-icon ui-icon-check"></span>').addClass('added');
                    }
                });
            });
        }
    }
})(jQuery);