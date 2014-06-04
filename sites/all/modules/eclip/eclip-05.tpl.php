<?php

$colores['title_font']        = 'Trebuchet MS, Helvetica, Arial';
$colores['category_size']     = variable_get('eclip_category_size', '18') . 'px';
$colores['title_size']        = variable_get('eclip_title_size', '18') . 'px';
$colores['fecha_size']        = variable_get('eclip_fecha_size', '12') . 'px';
$colores['bajada_size']       = variable_get('eclip_bajada_size', '12') . 'px';
$colores['general_size']      = variable_get('eclip_general_size', '12') . 'px';
$colores['title_weight']      = 'Bold';
$colores['title_margin_top']  = '0';
$colores['title_decoration']  = 'none';
$colores['image_position']    = 'none';
$colores['image_width']       = '302px';
$colores['image_height']      = '';

?>
<?php if($op == 'view') :// el clip se esta viendo (no esta siendo editado)?>
    <?php $news = _eclip_get_news_by_clip($node->nid); ?>
    <?php drupal_add_css(drupal_get_path('module', 'eclip') . '/css/eclip-05.css'); ?>
    <div class="main-background" style="background-color: <?php print $colores['background_color_inner'] ?>">
        <div class="zone-top main">
            <div class="zone-top-inner clearfix" style="border-top: 1px solid <?php print $colores['liston_header'] ?>">
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
        </div>
        <?php $colores['image_width'] = '302px'; ?>
        <div class="zone-middle">
            <div class="zone-middle-inner clearfix" style="border-top: 1px solid <?php print $colores['borde_zona'] ?>">
                <div class="column column1">
                    <div class="column-inner">
                        <?php print _theme_destacado($destacados, 3, 1, $colores); ?>
                    </div>
                </div>
                <div class="column column2">
                    <div class="column-inner">
                        <?php print _theme_destacado($destacados, 4, 1, $colores); ?>
                    </div>
                </div>
                <div class="column column3">
                    <div class="column-inner">
                        <?php print _theme_destacado($destacados, 5, 1, $colores); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        $colores['title_margin_top']  = '20px'; 
        $colores['image_position']    = 'left';
        $colores['image_width']       = '80px';
        ?>
        <div class="zone-bottom">
            <div class="zone-bottom-inner clearfix" style="border-top: 1px solid <?php print $colores['borde_zona'] ?>">
                <div class="column column1">
                    <div class="column-inner">
                        <?php print _theme_categoria($news, array('zone' => 1, 'colores' => $colores)); ?>
                    </div>            
                </div>
                <div class="column column2" style="border-left: 1px solid <?php print $colores['borde_zona'] ?>">
                    <div class="column-inner">
                        <?php print _theme_categoria($news, array('zone' => 2, 'colores' => $colores)); ?>
                    </div>
                </div>
                <div class="column column3"  style="border-left: 1px solid <?php print $colores['borde_zona'] ?>">
                    <div class="column-inner">
                        <?php print _theme_categoria($news, array('zone' => 3, 'colores' => $colores)); ?>
                    </div>
                </div>
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