<?php

/**
 * Build add clip form 
 */
function eclip_build_add_clip_page($node = NULL, $op = '') {
  $form = drupal_get_form('_eclip_jqueryui_theme_form', $node, $op);
  $output = drupal_render($form);
  return $output;
}

/**
 * Build jquery ui markups
 */
function _eclip_jqueryui_theme_form($form, $form_state, $node, $op) {
  $form['main'] = array(
    '#theme_wrappers' => array('container'),
    '#id' => 'main-content',
    '#attributes' => array('class' => array('settings-main')),
  );
  $form['main'] += eclip_build_add_eclip_form_top($form, $form_state, $node, $op);
  $form['main']['categories'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('eclip-ui-bucket', 'settings-categories')),
  );
  $form['main']['categories']['placeholder'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('clipper-placeholder', 'zone-0')),
    '#markup' => eclip_build_add_eclip_categories($form, $form_state, $node, $op),
  );

  $form['main']['bottom'] = array(
    '#theme_wrappers' => array('container'),
    '#id' => 'main-bottom',
    '#attributes' => array('class' => array('eclip-ui-bucket', 'clear-both')),
  );
  $form['main']['bottom']['hidden'] = array(
    '#theme_wrappers' => array('container'),
    '#type' => 'actions',
    '#attributes' => array('class' => array('hidden-fields')),
  );
  $form['main']['bottom']['hidden']['positions'] = array(
    '#type' => 'hidden',
    '#attributes' => array('id' => array('positions')),
  );
  $form['main']['bottom']['hidden']['node'] = array(
    '#type' => 'hidden',
    '#value' => isset($node->nid) ? $node->nid : null,
  );
  $form['main']['bottom']['hidden']['option'] = array(
    '#type' => 'hidden',
    '#value' => $op,
  );
  $form['main']['bottom']['actions'] = array(
    '#type' => 'actions',
    '#attributes' => array('class' => array('clear-both')),
  );
  $form['main']['bottom']['actions']['save'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );
  $form['main']['bottom']['actions']['delete'] = array(
    '#type' => 'submit',
    '#value' => t('Delete'),
  );
  return $form;
}

/**
 * Build top
 */
function eclip_build_add_eclip_form_top($form, $form_state, $node, $op) {
  $form['top'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('eclip-ui-bucket', 'settings-top')),
  );
  $options = _eclip_get_grupo_dropdown_options();
  $selected = isset($form_state['values']['grupo']) ? $form_state['values']['grupo'] : key($options);
  $form['top']['grupo'] = array(
    '#type' => 'select',
    '#title' => t('Grupo'),
    '#options' => $options,
    '#default_value' => $op == 'edit' ? $node->field_grupo['und'][0]['tid'] : $selected,
    '#disabled' => $op == 'edit' ? TRUE : FALSE,
  );
  
  $form['top']['categoria'] = array(
    '#type'    => 'select',
    '#title'   => t('Categoria'),
    '#empty_option' => t('Seleccionar'),
    '#options' => _eclip_get_taxonomy_options('categorias_clip'),
    '#disabled' => $op == 'edit' ? TRUE : FALSE,
  );  

  $form['top']['title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title'),
    '#size' => 15,
    '#default_value' => $op == 'edit' ? $node->title : date('d/m/Y'),
  );

  $dateformat = 'd/m/Y H:i';
  $form['top']['date_from'] = array(
    '#type' => 'date_popup',
    '#size' => 10,
    '#date_timezone' => date_default_timezone(),
    '#date_format' => $dateformat,
    '#date_year_range' => '-3:0',
    '#date_increment' => 15,
    '#default_value' => date('Y-m-d 00:00:00'),
  );

  $form['top']['date_to'] = array(
    '#type' => 'date_popup',
    '#size' => 10,
    '#date_timezone' => date_default_timezone(),
    '#date_format' => $dateformat,
    '#date_year_range' => '-3:0',
    '#date_increment' => 15,
    '#default_value' => date('Y-m-d 23:59:59'),
  );
  
  $form['top']['submit'] = array(
    '#type' => 'submit',
    '#ajax' => array(
      'callback' => 'eclip_change_date_callback',
      'name' => 'submit1',
      'progress' => array(
        'type' => 'throbber',
        'message' => '',
      ),      
    ),
    '#value' => t('Filtrar'),
  );

  $form['top']['clear'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('clear-both')),
  );
  return $form;
}

/**
 * Add categories
 */
function eclip_build_add_eclip_categories($form, $form_state, $node, $op) {
  if ($op == 'edit') {
    $output = views_embed_view('helper_get_categories', 'default', 0, $node->nid);
    $output .= '<div class="clear-both"></div>';
    return $output;
  }
  $categoria = $form_state['values']['categoria'] ? $form_state['values']['categoria'] : 'all';
  $grupo     = isset($form_state['values']['grupo']) && $form_state['values']['grupo'] ? $form_state['values']['grupo'] : 'all';
  $date_from = isset($form_state['values']['date_from']) && $form_state['values']['date_from'] ? format_date(strtotime($form_state['values']['date_from']), 'custom', 'YmdHi') : date('YmdHi');
  $date_to   = isset($form_state['values']['date_to']) && $form_state['values']['date_to'] ? format_date(strtotime($form_state['values']['date_to']), 'custom', 'YmdHi') : date('YmdHi');
  $output    = views_embed_view('todos_los_articulos', 'default', $grupo, $date_from, $date_to, $categoria);
  $output .= '<div class="clear-both"></div>';
  return $output;
}


/**
 * Validate form
 */
function _eclip_jqueryui_theme_form_validate($form, $form_state) {
  if ($form_state['values']['grupo'] == '') {
    form_set_error('grupo', 'Debe seleccionar un grupo');
  }
}

/**
 * Submit form
 */
function _eclip_jqueryui_theme_form_submit($form, $form_state) {
  //dpm($form_state);
  if ($form_state['values']['option'] == 'edit') {
    if (node_access('update', 'clip_grupo')) {
      $nid = $form_state['values']['node'];
      $node = node_load($nid);
      // node
      $node->title = $form_state['values']['title'];
      node_save($node);
      // positions
      _eclip_delete_positions($nid);
      $positions = unserialize($form_state['values']['positions']);
      _eclip_save_positions($nid, $positions['categories'], $positions['news']);
      drupal_set_message('Se ha editado correctamente el clip');
    }
  } elseif ($form_state['values']['option'] == 'add') {
    if (node_access('create', 'clip_grupo')) {
      //dpm($form_state);
      global $user;
      $node = new stdClass();
      $node->title = $form_state['values']['title'];
      $node->uid = $user->uid;
      $node->status = 1;
      $node->type = 'clip_grupo';
      $node->language = 'und';
      // fields
      $node->field_grupo = array('und' => array(array('tid' => $form_state['values']['grupo'])));
      $node->field_clip_maestro = array('und' => array(array('target_id' => $form_state['values']['node'])));
      node_save($node);
      $nid = $node->nid;
      $positions = unserialize($form_state['values']['positions']);
      _eclip_save_positions($nid, $positions['categories'], $positions['news']);
      drupal_set_message('Se ha creado correctamente un nuevo clip');
    }
  }
}

/**
 * Build add clip cliente form 
 */
function eclip_build_add_clip_cliente_page($node = NULL, $op = '') {
  $form = drupal_get_form('_eclip_jqueryui_cliente_theme_form', $node, $op);
  $output = drupal_render($form);
  return $output;
}

/**
 * Form for add clip cliente
 */
function _eclip_jqueryui_cliente_theme_form($form, $form_state, $node = NULL, $op = '') {
  drupal_add_library('system', 'ui.slider');
  $form['main'] = array(
    '#theme_wrappers' => array('container'),
    '#id' => 'main-content',
    '#attributes' => array('class' => array('settings-main')),
  );
  $form['main']+= eclip_build_add_eclip_cliente_form_top($form, $form_state, $node, $op);
  $form['main']['left'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('eclip-ui-bucket', 'settings-left')),
  );
  $form['main']['left']['file'] = array(
    '#type' => 'managed_file',
    '#name' => 'custom_content_block_image',
    '#title' => t('Imagen'),
    '#size' => 30,
    '#default_value' => isset($node->field_imagen_destacado['und'][0]['fid']) ? $node->field_imagen_destacado['und'][0]['fid'] : '',
    '#description' => t("Imagen del destacado."),
    '#upload_location' => 'public://'
  ); 
  $form['main']['left']['limite'] = array(
    '#type' => 'select',
    '#title' => t('Limite por categoría'),
    '#options' => array(3 => 3, 5 => 5, 7 => 7, 100 => t('Sin limite')),
    '#default_value' => isset($node->field_limite['und'][0]['value']) ? $node->field_limite['und'][0]['value'] : 5,
    '#description' => t('Número de notas que se muestran antes del [Ver más].'),
  );  
  $form['main']['left']['highlighted'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('zone-destacado')),
    '#markup' => eclip_build_add_eclip_cliente_highlighted($form, $form_state, $node, $op),
  );    
  $form['main']['left']['placeholder'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('clipper-placeholder', 'zone-0')),
    '#markup' => eclip_build_add_eclip_cliente_form_left($form, $form_state, $node, $op),
  );
  // Right settings
  if ($op == 'edit') {
    $template = node_load($node->field_theme['und'][0]['target_id']);
    $template_name = $template->field_machine_name['und'][0]['value'];
  } else {
    $template_name = 'eclip-01';
  }
  $form['main']['right'] = array(
    '#theme_wrappers' => array('container'),
    '#markup' => theme($template_name, array('op' => $op, 'node' => $node)),
    '#attributes' => array('class' => array('eclip-ui-bucket', 'settings-right')),
  );

  $form['main']['bottom'] = array(
    '#theme_wrappers' => array('container'),
    '#id' => 'main-bottom',
    '#attributes' => array('class' => array('eclip-ui-bucket', 'clear-both')),
  );
  $form['main']['bottom']['hidden'] = array(
    '#theme_wrappers' => array('container'),
    '#type' => 'actions',
    '#attributes' => array('class' => array('hidden-fields')),
  );
  $form['main']['bottom']['hidden'] = array(
    '#theme_wrappers' => array('container'),
    '#type' => 'actions',
    '#attributes' => array('class' => array('hidden-fields')),
  );
  $form['main']['bottom']['hidden']['positions'] = array(
    '#type' => 'hidden',
    '#attributes' => array('id' => array('positions')),
  ); 
  $form['main']['bottom']['hidden']['node'] = array(
    '#type' => 'hidden',
    '#value' => isset($node->nid) ? $node->nid : NULL,
  );
  $form['main']['bottom']['hidden']['option'] = array(
    '#type' => 'hidden',
    '#value' => $op,
  );
  $form['main']['bottom']['actions'] = array(
    '#type' => 'actions',
    '#attributes' => array('class' => array('clear-both')),
  );
  $form['main']['bottom']['actions']['save'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );   
  $form['main']['bottom']['actions']['delete'] = array(
    '#type' => 'submit',
    '#value' => t('Delete'),
  );
  return $form;
}

/**
 * Build form top for add clip cliente form
 */
function eclip_build_add_eclip_cliente_form_top($form, $form_state, $node = NULL, $op = '') {
  $form['top'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('eclip-ui-bucket', 'settings-top')),
  );
  $options = _eclip_get_grupo_dropdown_options();
  $selected = isset($node->field_grupo['und'][0]['tid']) ? $node->field_grupo['und'][0]['tid'] : key($options);
  $form['top']['grupo'] = array(
    //'#theme_wrappers' => array('container'),
    '#type' => 'select',
    '#title' => t('Grupo'),
    '#options' => $options,
    '#default_value' => $selected,
    '#prefix' => '<div id="settings-grupo">',
    '#suffix' => '</div>',
    '#disabled' => TRUE, // siempre deshabilitado ya sea para añadir o editar
  );
  $form['top']['dependant'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('id' => array('dependant-group')),
  );
  $form['top']['dependant']['cliente'] = array(
    '#type' => 'select',
    '#title' => t('Cliente'),
    '#prefix' => '<div id="settings-cliente">',
    '#suffix' => '</div>',
    '#options' => _eclip_get_cliente_dropdown_options($selected),
    '#default_value' => isset($node->field_cliente['und'][0]['target_id']) ? $node->field_cliente['und'][0]['target_id'] : '',
    '#disabled' => isset($node->field_cliente['und'][0]['target_id']) ? TRUE : FALSE,
    '#ajax' => array(
      'callback' => 'eclip_change_customer_callback',
      'progress' => array(
        'type' => 'throbber',
        'message' => '',
      ),
    ),
  );
  $templates = _eclip_get_all_templates();
  $options = array();
  foreach ($templates as $template) {
    $options[$template->nid] = $template->title;
  }
  $form['top']['template'] = array(
    '#type' => 'select',
    '#title' => t('Template'),
    '#options' => $options,
    '#prefix' => '<div id="settings-template">',
    '#suffix' => '</div>',
    '#ajax' => array(
      'callback' => 'eclip_change_template_callback',
    ),
    '#default_value' => isset($node->field_theme['und'][0]['target_id']) ? $node->field_theme['und'][0]['target_id'] : '',
    '#disabled' => isset($node->field_cliente['und'][0]['target_id']) ? TRUE : FALSE,
  );
  //dpm($node);
  $form['top']['clear'] = array(
    '#theme_wrappers' => array('container'),
    '#attributes' => array('class' => array('clear-both')),
  );
  return $form;
}

/**
 * Build form left for add clip cliente form
 */
function eclip_build_add_eclip_cliente_form_left($form, $form_state, $node = NULL, $op = '') {
  if ($op == 'edit') {
    return views_embed_view('helper_get_categories', 'default', 0, $node->nid, 'all');
  } elseif ($op == 'add') {
    return t('Seleccione un cliente');
  }
}

/**
 * Build form highlighted for add clip cliente form
 */
function eclip_build_add_eclip_cliente_highlighted($form, $form_state, $node = NULL, $op = '') {
  $output = '
  <div class="portlet-destacado ui-widget ui-widget-content ui-helper-clearfix">  
    <div class="portlet-header ui-widget-header">
      <span class="category-title">DESTACADOS</span>
      <span class="category-actions">
        <span class="ui-icon ui-icon-minusthick"></span>
      </span>
    </div>
    <div class="portlet-content">';
  if ($op == 'edit') {
    $output.= views_embed_view('helper_get_highlighted', 'default', $node->nid);
  } elseif ($op == 'add') {
    $output.= views_embed_view('helper_get_highlighted', 'default', 0);
  }
  $output.= '</div></div>';
  return $output;
}


/**
 * Validate function for add clip cliente form
 */
function _eclip_jqueryui_cliente_theme_form_validate($form, $form_state) {
  if ($form_state['values']['cliente'] == '') {
    form_set_error('cliente', 'Debe seleccionar un cliente');
  }
}

/**
 * Submit handler for add clip cliente form
 */ 
function _eclip_jqueryui_cliente_theme_form_submit($form, $form_state) {
  //dpm($form_state);dpm($form);
  if($form_state['values']['op'] == t('Save') ){
    if ($form_state['values']['option'] == 'edit') {
      if (node_access('update', 'clip')) {
        $nid = $form_state['values']['node'];
        // positions
        _eclip_delete_positions($nid);
        $positions = unserialize($form_state['values']['positions']);
        //watchdog('positions', print_r($positions, 1));
        _eclip_save_positions($nid, $positions['categories'], $positions['news'], $positions['highlighted']);
        $node = node_load($nid);
        if($form_state['values']['file']){
            $node->field_imagen_destacado = array('und' => array((array)file_load($form_state['values']['file'])));
        }else{
            unset($node->field_imagen_destacado);
        }
        $node->field_limite = array('und' => array(array('value' => $form_state['values']['limite'])));
        node_save($node);
        drupal_set_message('Se ha editado correctamente el clip');
      }
    } elseif ($form_state['values']['option'] == 'add') {
      if (node_access('create', 'clip')) {
        global $user;
        // nodo padre
        $node_grupo = node_load($form_state['values']['node']);
        $node_cliente = node_load($form_state['values']['cliente']);
        $node = new stdClass();
        $node->title = $node_cliente->title . ' - ' . date('d/m/Y');
        $node->uid = $user->uid;
        $node->status = 1;
        $node->type = 'clip';
        $node->language = 'und';
        // fields
        $node->field_grupo = array('und' => array(array('tid' => $node_grupo->field_grupo['und'][0]['tid'])));
        $node->field_clip_grupo = array('und' => array(array('target_id' => $form_state['values']['node'])));
        $node->field_cliente = array('und' => array(array('target_id' => $form_state['values']['cliente'])));
        $node->field_theme = array('und' => array(array('target_id' => $form_state['values']['template'])));
        if($form_state['values']['file']){
            $node->field_imagen_destacado = array('und' => array((array)file_load($form_state['values']['file'])));
        }
        $node->field_limite = array('und' => array(array('value' => $form_state['values']['limite'])));
        node_save($node);
        $nid = $node->nid;
        $positions = unserialize($form_state['values']['positions']);
        _eclip_save_positions($nid, $positions['categories'], $positions['news'], $positions['highlighted']);
        drupal_set_message('Se ha creado correctamente un nuevo clip');
      }
    }   
  }
  return;
}

/**
 * Change customer callback
 */
function eclip_change_customer_callback($form, $form_state) {
  $commands = array();
  if (isset($form_state['values']['cliente']) && isset($form_state['values']['node'])) {
    $last_clip = _eclip_get_last_clip_by_customer($form_state['values']['cliente']);
    if(isset($last_clip->nid)){
      // load last positions
      $last_positions = _eclip_get_positions_by_clip($last_clip->nid);
      drupal_add_js(array('eclip' => array('positions' => $last_positions)), 'setting');
    }   
    $cliente  = node_load($form_state['values']['cliente']);
    $nid      = $form_state['values']['node'];
    $tids     = array();
    foreach ($cliente->field_categoria['und'] as $categoria) {
      $tids[] = $categoria['tid'];
    }
    $args       = implode('+', $tids);
    $output     = views_embed_view('helper_get_categories', 'default', 0, $nid, $args);
    $commands[] = ajax_command_html('.clipper-placeholder.zone-0', $output);
    $commands[] = eclip_command_update_positions();
  } else {
    $commands[] = ajax_command_html('.clipper-placeholder.zone-0', t('Error'));
  }
  return array('#type' => 'ajax', '#commands' => $commands);
}

/**
 * Change template callback
 */
function eclip_change_template_callback($form, $form_state) {
  $commands = array();
  $template = node_load($form_state['values']['template']);
  $template_name = $template->field_machine_name['und'][0]['value'];
  $commands[] = ajax_command_html('.settings-right', theme($template_name, array('op' => 'edit', 'node' => NULL)));
  //$commands[] = ajax_command_html('.settings-left', eclip_build_add_eclip_cliente_form_left($form, $form_state));
  return array('#type' => 'ajax', '#commands' => $commands);
}

/**
 * Change date callback
 */
function eclip_change_date_callback($form, $form_state) {
  $commands[] = ajax_command_html('.clipper-placeholder.zone-0', eclip_build_add_eclip_categories($form, $form_state));
  return array('#type' => 'ajax', '#commands' => $commands);
}

/**
 * Send clip callback
 */
function eclip_build_send_clip_callback($node, $type){
  eclip_send_clip($node, $type);
  //$messages = drupal_get_messages();
  $commands[] = ajax_command_prepend('#content', theme('status_messages'));
  $page = array('#type' => 'ajax', '#commands' => $commands);
  ajax_deliver($page);
}