<?php

/**
 * Override of theme_breadcrumb().
 */
function eclip_theme_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $output .= '<div class="breadcrumb">' . implode(' › ', $breadcrumb) . '</div>';
    return $output;
  }
}

/**
 * Override or insert variables into the maintenance page template.
 */
function eclip_theme_preprocess_maintenance_page(&$vars) {
  // While markup for normal pages is split into page.tpl.php and html.tpl.php,
  // the markup for the maintenance page is all in the single
  // maintenance-page.tpl.php template. So, to have what's done in
  // eclip_preprocess_html() also happen on the maintenance page, it has to be
  // called here.
  eclip_theme_preprocess_html($vars);
}

/**
 * Override or insert variables into the html template.
 */
function eclip_theme_preprocess_html(&$vars) {
  // Toggle fixed or fluid width.  
  if (theme_get_setting('eclip_theme_width') == 'fluid') {
    $vars['classes_array'][] = 'fluid-width';
  }
  // Add conditional CSS for IE6.
  drupal_add_css(path_to_theme() . '/fix-ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lt IE 7', '!IE' => FALSE), 'preprocess' => FALSE));

  drupal_add_js('sites/all/libraries/flowplayer/flowplayer-3.2.13.min.js');
}

/**
 * Override or insert variables into the html template.
 */
function eclip_theme_process_html(&$vars) {
  // Hook into color.module
  if (module_exists('color')) {
    _color_html_alter($vars);
  }
}

/**
 * Override or insert variables into the page template.
 */
function eclip_theme_preprocess_page(&$vars) {
  // Move secondary tabs into a separate variable.
  $vars['tabs2'] = array(
    '#theme' => 'menu_local_tasks',
    '#secondary' => $vars['tabs']['#secondary'],
  );
  unset($vars['tabs']['#secondary']);

  if (isset($vars['main_menu'])) {
    $vars['primary_nav'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'inline', 'main-menu'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['primary_nav'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_nav'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'inline', 'secondary-menu'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_nav'] = FALSE;
  }

  // Prepare header.
  $site_fields = array();
  if (!empty($vars['site_name'])) {
    $site_fields[] = $vars['site_name'];
  }
  if (!empty($vars['site_slogan'])) {
    $site_fields[] = $vars['site_slogan'];
  }
  $vars['site_title'] = implode(' ', $site_fields);
  if (!empty($site_fields)) {
    $site_fields[0] = '<span>' . $site_fields[0] . '</span>';
  }
  $vars['site_html'] = implode(' ', $site_fields);

  // Set a variable for the site name title and logo alt attributes text.
  $slogan_text = $vars['site_slogan'];
  $site_name_text = $vars['site_name'];
  $vars['site_name_and_slogan'] = $site_name_text . ' ' . $slogan_text;
  // Adding custom colors/background
  $vars['customer_header'] = '';
  $vars['footer_text'] = '';
  $vars['is_intranet'] = arg(0) == 'intranet' ? TRUE : FALSE;
  if((arg(0) == 'clip' || arg(0) == 'intranet') && arg(1) != ''){
    $cliente    = load_customer_by_hash(arg(1));
    if(!empty($cliente)){
      if(isset($cliente->field_header['und'][0]['uri']) && $header_uri = $cliente->field_header['und'][0]['uri']){
        $image = theme('image', array('path' => $header_uri));
        $vars['customer_header'] = l($image, arg(0) . '/' . $cliente->field_hash['und'][0]['value'], array('html' => TRUE));        
      }

      if(isset($cliente->field_footer_image['und'][0]['uri']) && $footer_uri = $cliente->field_footer_image['und'][0]['uri']){
        $vars['footer_image'] = theme('image', array('path' => $footer_uri));       
      }      
      $vars['footer_text'] = _eclip_theme_render_field($cliente, $cliente->field_footer, 'field_footer');
      $page_title = _eclip_theme_render_field($cliente, $cliente->field_page_title, 'field_page_title');
      drupal_set_title($page_title);

      $vars['colores']['liston_header'] = _eclip_theme_render_field($cliente, $cliente->field_liston_header, 'field_liston_header');
      $vars['colores']['body_background'] = _eclip_theme_render_field($cliente, $cliente->field_background_color, 'field_background_color');
      $vars['colores']['category_background'] = _eclip_theme_render_field($cliente, $cliente->field_category_background, 'field_category_background');
      $vars['colores']['liston_color'] = _eclip_theme_render_field($cliente, $cliente->field_liston_color, 'field_liston_color');
      $vars['colores']['category_color'] = _eclip_theme_render_field($cliente, $cliente->field_category_color, 'field_category_color');
      $vars['colores']['link_color'] = _eclip_theme_render_field($cliente, $cliente->field_link_color, 'field_link_color');
      $vars['colores']['link_color_2'] = _eclip_theme_render_field($cliente, $cliente->field_link_color_2, 'field_link_color_2');
      $vars['colores']['background_color_inner'] = _eclip_theme_render_field($cliente, $cliente->field_background_color_inner, 'field_background_color_inner');
      $vars['colores']['font_color'] = _eclip_theme_render_field($cliente, $cliente->field_font_color, 'field_font_color');
      $vars['colores']['image_border'] = _eclip_theme_render_field($cliente, $cliente->field_image_border, 'field_image_border');
      $vars['colores']['page_border'] = _eclip_theme_render_field($cliente, $cliente->field_page_border, 'field_page_border');
      $vars['colores']['news_border'] = _eclip_theme_render_field($cliente, $cliente->field_news_border, 'field_news_border');
      $vars['colores']['background_footer'] = _eclip_theme_render_field($cliente, $cliente->field_background_footer, 'field_background_footer');
      $vars['colores']['footer_color'] = _eclip_theme_render_field($cliente, $cliente->field_footer_color, 'field_footer_color');
      $vars['colores']['borde_zona'] = _eclip_theme_render_field($cliente, $cliente->field_borde_zona, 'field_borde_zona'); 
      $vars['colores']['borde_inferior_destacado'] = _eclip_theme_render_field($cliente, $cliente->field_borde_inferior_destacado, 'field_borde_inferior_destacado');
      $vars['colores']['borde_destacado'] = _eclip_theme_render_field($cliente, $cliente->field_borde_destacado, 'field_borde_destacado');

      isset($cliente->field_background_color['und'][0]['rgb']) ? drupal_add_css('body { background-color: ' . $cliente->field_background_color['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_category_background['und'][0]['rgb']) ? drupal_add_css('.category-title { background-color: ' . $cliente->field_category_background['und'][0]['rgb'] . ' !important ; width: 98%; padding: 2px 1%; }', array('type' => 'inline')) : '';
      isset($cliente->field_liston_color['und'][0]['rgb']) ? drupal_add_css('.category-title { border-bottom: 2px solid ' . $cliente->field_liston_color['und'][0]['rgb'] . ' !important ; }', array('type' => 'inline')) : '';
      isset($cliente->field_category_color['und'][0]['rgb']) ? drupal_add_css('.category-title { color: ' . $cliente->field_category_color['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_link_color['und'][0]['rgb']) ? drupal_add_css('a { color: ' . $cliente->field_link_color['und'][0]['rgb'] . ';}', array('type' => 'inline')) : '';
      isset($cliente->field_link_color_2['und'][0]['rgb']) ? drupal_add_css('a.vermas { color: ' . $cliente->field_link_color_2['und'][0]['rgb'] . ';}', array('type' => 'inline')) : '';
      isset($cliente->field_background_color_inner['und'][0]['rgb']) ? drupal_add_css('#contentConteiner { background-color: ' . $cliente->field_background_color_inner['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_font_color['und'][0]['rgb']) ? drupal_add_css('body {color :' . $cliente->field_font_color['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_image_border['und'][0]['rgb']) ? drupal_add_css('img { border: 1px solid ' . $cliente->field_image_border['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_page_border['und'][0]['rgb']) ? drupal_add_css('#mainConteiner { border: 1px solid ' . $cliente->field_page_border['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';    
      isset($cliente->field_news_border['und'][0]['rgb']) ? drupal_add_css('.news-item { border: 1px solid ' . $cliente->field_news_border['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_background_footer['und'][0]['rgb']) ? drupal_add_css('#footer { background-color:  ' . $cliente->field_background_footer['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_footer_color['und'][0]['rgb']) ? drupal_add_css('#footer { color: ' . $cliente->field_footer_color['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      
      isset($cliente->field_borde_zona['und'][0]['rgb']) ? drupal_add_css('.zone-3-inner, .main-left-inner, .main-center-inner, .main-bottom  { border-color: ' . $cliente->field_borde_zona['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_borde_inferior_destacado['und'][0]['rgb']) ? drupal_add_css('.destacado, .destacado-2, .destacado-2 .views-field-nothing { border-color: ' . $cliente->field_borde_inferior_destacado['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
      isset($cliente->field_borde_destacado['und'][0]['rgb']) ? drupal_add_css('.destacado img  { border-color: ' . $cliente->field_borde_destacado['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';      
      //isset($cliente->field_news_border['und'][0]['rgb']) ? drupal_add_css('.news-item { border-color: ' . $cliente->field_news_border['und'][0]['rgb'] . ' !important ;}', array('type' => 'inline')) : '';
//      
      //drupal_add_css('body {background: url("' . $background . '") !important ;}', array('type' => 'inline'));     
    }
  }
}

/**
 * Helper, get customer by hash
 * @param type $hash
 * @return type 
 */
function load_customer_by_hash($hash){
  $query = db_select('node', 'n');
  $query->innerJoin('field_data_field_hash', 'h', 'h.entity_id = n.nid AND (h.entity_type = :type AND h.deleted = :deleted)', array(':type' => 'node', ':deleted' => 0));
  $query
    ->fields('n', array('nid'))
    ->condition('n.type', 'cliente')
    ->condition('n.status', '1')
    ->condition('h.field_hash_value', $hash);
  $result = $query->execute()->fetchAll();    
  if(isset($result[0]->nid)){
    return node_load($result[0]->nid);
  }
}

/**
 * Override or insert variables into the node template.
 */
function eclip_theme_preprocess_node(&$vars) {
    $vars['submitted'] = $vars['date'] . ' — ' . $vars['name'];
    //dpm($vars['node']);
    if($vars['node']->type == 'clip'){
        if(isset($vars['node']->field_cliente['und'][0]['target_id'])){
          $cliente = node_load($vars['node']->field_cliente['und'][0]['target_id']);
          $vars['colores']['liston_header'] = _eclip_theme_render_field($cliente, $cliente->field_liston_header, 'field_liston_header');
          $vars['colores']['body_background'] = _eclip_theme_render_field($cliente, $cliente->field_background_color, 'field_background_color');
          $vars['colores']['category_background'] = _eclip_theme_render_field($cliente, $cliente->field_category_background, 'field_category_background');
          $vars['colores']['liston_color'] = _eclip_theme_render_field($cliente, $cliente->field_liston_color, 'field_liston_color');
          $vars['colores']['category_color'] = _eclip_theme_render_field($cliente, $cliente->field_category_color, 'field_category_color');
          $vars['colores']['link_color'] = _eclip_theme_render_field($cliente, $cliente->field_link_color, 'field_link_color');
          $vars['colores']['link_color_2'] = _eclip_theme_render_field($cliente, $cliente->field_link_color_2, 'field_link_color_2');
          $vars['colores']['background_color_inner'] = _eclip_theme_render_field($cliente, $cliente->field_background_color_inner, 'field_background_color_inner');
          $vars['colores']['font_color'] = _eclip_theme_render_field($cliente, $cliente->field_font_color, 'field_font_color');
          $vars['colores']['image_border'] = _eclip_theme_render_field($cliente, $cliente->field_image_border, 'field_image_border');
          $vars['colores']['page_border'] = _eclip_theme_render_field($cliente, $cliente->field_page_border, 'field_page_border');
          $vars['colores']['news_border'] = _eclip_theme_render_field($cliente, $cliente->field_news_border, 'field_news_border');
          $vars['colores']['background_footer'] = _eclip_theme_render_field($cliente, $cliente->field_background_footer, 'field_background_footer');
          $vars['colores']['footer_color'] = _eclip_theme_render_field($cliente, $cliente->field_footer_color, 'field_footer_color');
          $vars['colores']['borde_zona'] = _eclip_theme_render_field($cliente, $cliente->field_borde_zona, 'field_borde_zona'); 
          $vars['colores']['borde_inferior_destacado'] = _eclip_theme_render_field($cliente, $cliente->field_borde_inferior_destacado, 'field_borde_inferior_destacado');
          $vars['colores']['borde_destacado'] = _eclip_theme_render_field($cliente, $cliente->field_borde_destacado, 'field_borde_destacado'); 
          // email
          $vars['colores']['title_font']   = '';
          $vars['colores']['title_size']   = '';
          $vars['colores']['title_weight'] = ''; 
          $vars['colores']['title_decoration']  = 'none';

        }

        $vars['imagen'] = '';
        if(isset($vars['node']->field_imagen_destacado['und'][0])){        
            $field = field_get_items('node', $vars['node'], 'field_imagen_destacado');
            $vars['imagen'] = field_view_value('node', $vars['node'], 'field_imagen_destacado', $field[0], 'default');
        }
        $destacados = views_get_view_result('front_destacados', 'todos', $vars['node']->nid);
        //dpm($destacados);
        $vars['destacados'] = array();
        foreach ($destacados as $destacado) {
          $noticia = new stdClass();
          $noticia->titulo  = $destacado->node_eclip_article_data_title;
          $noticia->show_image  = $destacado->eclip_article_data_image;
          $noticia->clip_nid    = $destacado->eclip_article_data_clip_nid;
          $noticia->article_id  = $destacado->article_data_id;
          $noticia->fuente      = isset($destacado->field_field_fuente[0]['rendered']['#markup']) ? $destacado->field_field_fuente[0]['rendered']['#markup'] : '';
          $noticia->environment = arg(0);
          $noticia->space       = arg(1);
          $noticia->medio   = isset($destacado->field_field_medio[0]['rendered']['#markup']) ? $destacado->field_field_medio[0]['rendered']['#markup'] : '';
          $noticia->bajada  = isset($destacado->field_body[0]['rendered']['#markup']) ? $destacado->field_body[0]['rendered']['#markup'] : '';
          $noticia->fecha   = isset($destacado->field_field_fecha[0]['raw']['value']) ? $destacado->field_field_fecha[0]['raw']['value'] : '';
          $noticia->imagen  = isset($destacado->field_field_server_destacado[0]['raw']['url']) ? _eclip_get_url_file($destacado->field_field_server_destacado[0]['raw']['url']) : '';
          $vars['destacados'][] = $noticia;
        }

        //dpm($destacados);
        
        $vars['destacados1'] = '';
        if(views_get_view_result('front_destacados', 'block_1', $vars['node']->nid)){
            $vars['destacados1'] = views_embed_view('front_destacados', 'block_1', $vars['node']->nid);
        };        
        
        $vars['destacados2'] = '';
        if(views_get_view_result('front_destacados', 'block_2', $vars['node']->nid)){
            $vars['destacados2'] = views_embed_view('front_destacados', 'block_2', $vars['node']->nid);
        };

        if(isset($vars['node']->field_theme['und'][0]['target_id'])){
            $template = node_load($vars['node']->field_theme['und'][0]['target_id']);
            $vars['template'] = $template->field_machine_name['und'][0]['value'];        
        }else{
            $vars['template'] = 'eclip-01';
        }
    }    
}

/**
 * Override or insert variables into the comment template.
 */
function eclip_theme_preprocess_comment(&$vars) {
  $vars['submitted'] = $vars['created'] . ' — ' . $vars['author'];
}

/**
 * Override or insert variables into the block template.
 */
function eclip_preprocess_block(&$vars) {
  $vars['title_attributes_array']['class'][] = 'title';
  $vars['classes_array'][] = 'clearfix';
}

/**
 * Override or insert variables into the page template.
 */
function eclip_theme_process_page(&$vars) {
  // Hook into color.module
  if (module_exists('color')) {
    _color_page_alter($vars);
  }
}

/**
 * Override or insert variables into the region template.
 */
function eclip_theme_preprocess_region(&$vars) {
  if ($vars['region'] == 'header') {
    $vars['classes_array'][] = 'clearfix';
  }
}
