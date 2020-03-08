<?php 
	require_once __DIR__ . '/One_Password.php';

	$one_password = new One_Password();

	$one_password->load_items();

	if( isset( $_GET['search'] ) ) {
		$items = $one_password->get_items_by_search_term( $_GET['search'] );
		foreach( $items as $item ) {
			include __DIR__ . '/item-template.php';
		}
	} else {
		foreach ( $one_password->get_items() as $key => $item ) {
			include __DIR__ . '/item-template.php';
		}
	}