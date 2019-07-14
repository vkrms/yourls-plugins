<?php

yourls_add_action( 'yourls_ajax_get_options', function() {
	global $ydb;
	$query = 'SELECT * FROM utmc_params';
	// $result = ;
	$query_results = $ydb->get_results( $query );

	// GROUP BY TYPE
	// get all distinct types from db
	$values = $ydb->get_col( 'SELECT value FROM utmc_params ORDER BY used DESC' );

	$result = [];
	foreach ( $values as $str ) {
		$frags = explode( '=', $str );
		$type  = $frags[0];
		$val   = $frags[1];

		$result[ $type ][] = $val;
	}

	echo json_encode( $result );

	die();
});
