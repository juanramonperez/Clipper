<?php

function eclip_export_clip($node){
	// Load library
	module_load_include('inc', 'phpexcel');
	$data 	 = array();
	$headers = array();
	// First worksheet
	// Get the nodes
	$query = db_select('eclip_article_data', 'ea');
	$query->leftJoin('node', 'n1', 'ea.clip_nid = n1.nid');
	$query->leftJoin('node', 'n2', 'ea.article_id = n2.nid');
	$query->leftJoin('eclip_cat_data', 'ec', 'ea.cat_tid = ec.cat_tid');
	$query->fields('n2', array('title'))
			->fields('ea', array('vote'))
			->fields('ec', array('cat_tid'))
			->condition('n1.nid', $node->nid)			
			->distinct()
			->range(0, 100);
	$result = $query->execute();
	while($row = $result->fetchAssoc()) {
		if (!count($headers)) {
		  // Add the headers for the first worksheet
		  $headers['Nodes'] = array_keys($row);
		}
		// Add the data
		$data['Nodes'][] = array_values($row);
	}
	// Second workset
	// Get destacados
	$query = db_select('eclip_article_data', 'ea');
	$query->leftJoin('node', 'n1', 'ea.clip_nid = n1.nid');
	$query->leftJoin('node', 'n2', 'ea.article_id = n2.nid');
	$query->leftJoin('eclip_cat_data', 'ec', 'ea.cat_tid = ec.cat_tid');
	$query->fields('n2', array('title'))
			->fields('ea', array('vote'))
			->fields('ec', array('cat_tid'))
			->condition('n1.nid', $node->nid)			
			->distinct()
			->range(0, 100);
	$result = $query->execute();
	while($row = $result->fetchAssoc()) {
		if (!count($headers)) {
		  // Add the headers for the first worksheet
		  $headers['Nodes'] = array_keys($row);
		}
		// Add the data
		$data['Nodes'][] = array_values($row);
	}	
	// Store the file in sites/default/files
	$dir  = file_stream_wrapper_get_instance_by_uri('public://')->realpath();
	$path = "$dir/export.xls";
	// Use the .xls format
	$result = phpexcel_export($headers, $data, $path, array('format' => 'xls'));
	if ($result == PHPEXCEL_SUCCESS) {
		drupal_set_message(t("We did it !"));
	} else {
		drupal_set_message(t("Oops ! An error occured !"), 'error');
	}	
	return 'hola';
}