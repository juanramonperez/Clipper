<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if($op == 'view') :// el clip se esta viendo (no esta siendo editado)?>
    <?php $news = _eclip_get_news_by_clip($node->nid); ?>
    <!--
    <div class="main-title">
        <div class="title">
            Destacados
        </div>
    </div>
    -->
    <div class="zone-top main clearfix" style="background-color: <?php print $colores['background_color_inner'] ?>">
        <div class="column column1">
            <div class="column-inner">
                <?php print _theme_destacado($destacados, 0, 1, $colores); ?>
            </div>
        </div>
        <div class="column column2">
            <div class="column-inner">
                <?php print _theme_destacado($destacados, 1, 1, $colores); ?>
            </div>
        </div>
        <div class="column column3">
            <div class="column-inner">
                <?php print _theme_destacado($destacados, 2, 1, $colores); ?>
            </div>
        </div>
    </div>
    <div class="zone-middle clearfix"  style="background-color: <?php print $colores['background_color_inner'] ?>">
        <div class="column column1">
            <div class="column-inner">
                <?php print _theme_destacado($destacados, 3, 1, $colores); ?>
            </div>
        </div>
        <div class="column column2" style="border-left: 1px solid <?php print $colores['borde_zona'] ?>">
            <div class="column-inner">
                <?php print _theme_destacado($destacados, 4, 1, $colores); ?>
            </div>
        </div>
        <div class="column column3" style="border-left: 1px solid <?php print $colores['borde_zona'] ?>">
            <div class="column-inner">
                <?php print _theme_destacado($destacados, 5, 1, $colores); ?>
            </div>
        </div>
    </div>
    <div class="zone-bottom clearfix" style="background-color: <?php print $colores['background_color_inner'] ?>">
        <div class="column column1">
            <div class="column-inner">
                <?php print _theme_categoria($news, 1, $colores); ?>
            </div>            
        </div>
        <div class="column column2" style="border-left: 1px solid <?php print $colores['borde_zona'] ?>">
            <div class="column-inner">
                <?php print _theme_categoria($news, 2, $colores); ?>
            </div>
        </div>
        <div class="column column3"  style="border-left: 1px solid <?php print $colores['borde_zona'] ?>">
            <div class="column-inner">
                <?php print _theme_categoria($news, 3, $colores); ?>
            </div>
        </div>
    </div>
<?php else: ?>
<div class="main-template eclip-05">
  <div class="main-template-inner">
    <div class="main-left">
      <div class="main-left-inner">
        <div class="clipper-placeholder zone-1"><span class="zone-label">Zone 01</span><?php isset($node->nid) ? print views_embed_view('helper_get_categories', 'default', 1, $node->nid) : ''; ?></div>
      </div>      
    </div>
    <div class="main-center">
      <div class="main-center-inner">
        <div class="clipper-placeholder zone-2"><span class="zone-label">Zone 02</span><?php isset($node->nid) ? print views_embed_view('helper_get_categories', 'default', 2, $node->nid) : ''; ?></div>
      </div>      
    </div>    
    <div class="main-right">
      <div class="main-right-inner">
        <div class="clipper-placeholder zone-3"><span class="zone-label">Zone 03</span><?php isset($node->nid) ? print views_embed_view('helper_get_categories', 'default', 3, $node->nid) : ''; ?></div>
      </div>        
    </div>
  </div>
</div>
<?php endif; ?>