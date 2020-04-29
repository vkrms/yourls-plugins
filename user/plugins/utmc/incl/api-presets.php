<?php

error_reporting( '~E_NOTICE' );

// get all presets
yourls_add_action( 'yourls_ajax_get_presets', function() {
	global $ydb;

	$results = $ydb->get_results( 'SELECT * FROM `utmc_presets`' );

	echo json_encode( $results );
	die();
});

// save a preset
yourls_add_action( 'yourls_ajax_save_preset', function() {
	global $ydb;

	// foreach ( $_GET as $key => $param ) {
	// 	if ( is_array( $param ) ) {
	// 		$_GET[ $key ] = json_encode( $param );
	// 	}
	// }

	$name         = $_GET['name'];
	$utm_source   = $_GET['utm_source'];
	$utm_medium    = $_GET['utm_medium'];
	$utm_campaign = $_GET['utm_campaign'];
	$utm_content  = $_GET['utm_content'];
	$utm_term     = $_GET['utm_term'];

	$query = "INSERT IGNORE INTO `utmc_presets`
		(`name`, `utm_source`, `utm_medium`, `utm_campaign`, `utm_content`, `utm_term`)
		VALUES ('$name', '$utm_source', '$utm_medium', '$utm_campaign', '$utm_content', '$utm_term')";

	$status = $ydb->query( $query );

	if ( $status ) {
		echo json_encode([
			'status' => 200,
		]);
		return;
	}

	echo json_encode([
		'status' => 400,
	]);

	die();
});

// remove preset
yourls_add_action( 'yourls_ajax_remove_preset', function() {
	global $ydb;

	$id = $_GET['id'];

	$query = "DELETE FROM `urls`.`utmc_presets` WHERE (`id` = $id)";

	$ydb->query( $query );
});
