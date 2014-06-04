<?php

/**
 * @file
 * Views hooks implemented for the Eclip module.
 */

function eclip_views_data() {
  /*
   * Category data table definitions.
   */
  $data['eclip_cat_data']['table']['group'] = t('Category data');
  $data['eclip_cat_data']['table']['base'] = array(
    'field' => 'cat_data_id',
    'title' => t('Categories'),
    'help' => t('List of categories used in zones.'),
  );
  $data['eclip_cat_data']['table']['join'] = array(
    'eclip_zone' => array(
      'left_field' => 'zone_id',
      'field' => 'zone_id',
      'type' => 'INNER',
    ),
    'node' => array(
      'left_field' => 'nid',
      'field' => 'clip_nid',
      'type' => 'INNER',
    ),    
    'taxonomy_term_data' => array(
      'left_field' => 'tid',
      'field' => 'cat_tid',
      'type' => 'INNER',
    ),    
  );

  // category data id
  $data['eclip_cat_data']['cat_data_id'] = array(
    'title' => t('Category data ID'),
    'help' => t('The category data ID.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Category data ID'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  
  // zone id
  $data['eclip_cat_data']['zone_id'] = array(
    'title' => t('Zone'),
    'help' => t('The zone asociated with this category.'),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
    'filter' => array(
      'title' => t('Zone ID'),
      'handler' => 'views_handler_filter_numeric',
    ),   
  );
  
  // clip nid
  $data['eclip_cat_data']['clip_nid'] = array(
    'title' => t('Node'),
    'help' => t('The clip node asociated with this position.'),
    'relationship' => array(
      'base' => 'node',
      'base field' => 'nid',
      'handler' => 'views_handler_relationship',
      'label' => t('Node'),
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),    
  );
  
  // term tid
  $data['eclip_cat_data']['cat_tid'] = array(
    'title' => t('Term'),
    'help' => t('The category term asociated with this position.'),
    'relationship' => array(
      'base' => 'taxonomy_term_data',
      'base field' => 'tid',
      'handler' => 'views_handler_relationship',
      'label' => t('Term'),
    ),
    'filter' => array(
      'title' => t('Category term'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),    
  );   

  $data['eclip_cat_data']['weight'] = array(
    'title' => t('Category weight'),
    'help' => t('The category data weight.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Category weight'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  $data['eclip_cat_data']['priority'] = array(
    'title' => t('Category priority'),
    'help' => t('The category priority.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );   
  /*
   * Article data table definitions.
   */
  $data['eclip_article_data']['table']['group'] = t('Article data');
  $data['eclip_article_data']['table']['base'] = array(
    'field' => 'article_data_id',
    'title' => t('Articles'),
    'help' => t('List of articles used in group of zones.'),
  );
  $data['eclip_article_data']['table']['join'] = array(
    'eclip_cat_data' => array(
      'left_field' => 'cat_tid',
      'field' => 'cat_tid',
      'type' => 'INNER',
    ),
    'node' => array(
      'left_field' => 'nid',
      'field' => 'clip_nid',
      'type' => 'INNER',
    ),    
    'node' => array(
      'left_field' => 'nid',
      'field' => 'article_id',
      'type' => 'INNER',
    ),    
  );

  // article data id
  $data['eclip_article_data']['article_data_id'] = array(
    'title' => t('Article data ID'),
    'help' => t('The article data  ID.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Article data ID'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  
  // nid
  $data['eclip_article_data']['cat_tid'] = array(
    'title' => t('Category data'),
    'help' => t('The category data asociated with this position.'),
    'relationship' => array(
      'base' => 'eclip_cat_data',
      'base field' => 'cat_tid',
      'handler' => 'views_handler_relationship',
      'label' => t('Category data'),
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),    
  );
  // clip nid
  $data['eclip_article_data']['clip_nid'] = array(
    'title' => t('Clip'),
    'help' => t('The clip node asociated with this position.'),
    'relationship' => array(
      'base' => 'node',
      'base field' => 'nid',
      'handler' => 'views_handler_relationship',
      'label' => t('Node'),
    ),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Clip nid'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),    
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),    
  );  
  // article id
  $data['eclip_article_data']['article_id'] = array(
    'title' => t('New'),
    'help' => t('The article node asociated with this position.'),
    'relationship' => array(
      'base' => 'node',
      'base field' => 'nid',
      'handler' => 'views_handler_relationship',
      'label' => t('Node'),
    ),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Node ID'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),    
  );  

  $data['eclip_article_data']['weight'] = array(
    'title' => t('Article weight'),
    'help' => t('The article data weight.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Article weight'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  $data['eclip_article_data']['status'] = array(
    'title' => t('Article status'),
    'help' => t('The article status (0 = unpublished, 1 = published).'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Article data ID'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  $data['eclip_article_data']['vote'] = array(
    'title' => t('Vote'),
    'help' => t('The customer vote.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Vote'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  $data['eclip_article_data']['grupo'] = array(
    'title' => t('Group'),
    'help' => t('The article group.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Group'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  $data['eclip_article_data']['highlighted'] = array(
    'title' => t('Highlighted'),
    'help' => t('Boolean that indicate if article is highlighted or not.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Highlighted'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  $data['eclip_article_data']['image'] = array(
    'title' => t('Show image'),
    'help' => t('Boolean that indicate if the news should show his image.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Show image'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );  
  
  /*
   * Highlighted data table definitions.
   */
  $data['eclip_highlighted']['table']['group'] = t('Highlighted');
  $data['eclip_highlighted']['table']['base'] = array(
    'field' => 'article_data_id',
    'title' => t('Highlighted'),
    'help' => t('List of highlighted articles.'),
  );
  $data['eclip_highlighted']['table']['join'] = array(
    'node' => array(
      'left_field' => 'nid',
      'field' => 'clip_nid',
      'type' => 'INNER',
    ),    
    'node' => array(
      'left_field' => 'nid',
      'field' => 'article_id',
      'type' => 'INNER',
    ),    
  );

  // article data id
  $data['eclip_highlighted']['id'] = array(
    'title' => t('Highlighted ID'),
    'help' => t('The highlighted ID.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Highlighted ID'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );

  // clip nid
  $data['eclip_highlighted']['clip_nid'] = array(
    'title' => t('Node'),
    'help' => t('The clip node asociated with this position.'),
    'relationship' => array(
      'base' => 'node',
      'base field' => 'nid',
      'handler' => 'views_handler_relationship',
      'label' => t('Node'),
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),    
  );  
  // article id
  $data['eclip_highlighted']['article_id'] = array(
    'title' => t('Node'),
    'help' => t('The article node asociated with this position.'),
    'relationship' => array(
      'base' => 'node',
      'base field' => 'nid',
      'handler' => 'views_handler_relationship',
      'label' => t('Node'),
    ),
  );  

  $data['eclip_highlighted']['weight'] = array(
    'title' => t('Article weight'),
    'help' => t('The article data weight.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Article weight'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  $data['eclip_highlighted']['status'] = array(
    'title' => t('Article status'),
    'help' => t('The article status (0 = unpublished, 1 = published).'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Article data ID'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );
  $data['eclip_highlighted']['vote'] = array(
    'title' => t('Vote'),
    'help' => t('The customer vote.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'title' => t('Vote'),
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );  
  return $data;
}
