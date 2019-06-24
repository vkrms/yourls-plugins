<?php
/*
Plugin Name: UTM Constructor
Plugin URI: ¯\_(ツ)_/¯
Description: This plugin constructs urls with utm parameters
Version: 1.0
Author: vkrms
Author URI: github.com/vkrms
*/

ini_set( 'display_errors', 1 );
error_reporting( -1 );


function utmc_resource( $url ) {
	$dir_rel = str_replace( $_SERVER['DOCUMENT_ROOT'], '', __DIR__ ) . DIRECTORY_SEPARATOR;
	return $dir_rel . $url;
}

// Add markup, styles and scripts
yourls_add_action( 'admin_page_before_table', function() {
	require( 'utmc-template.php' );
});

// Add bulk page via hook
yourls_add_action( 'plugins_loaded', function() {
	yourls_register_plugin_page( 'utmc_bulk', 'Bulk UTM Constructor', 'utmc_bulk_page' );
});

// This renders the bulk page
function utmc_bulk_page() {
	require( 'utmc-bulk-template.php' );
};

yourls_add_action( 'yourls_ajax_add_links', function() {
	// yourls_verify_nonce( 'add_url', $_REQUEST['nonce'], false, 'omg error' );
	foreach ( $_REQUEST['urls'] as $url ) {
		yourls_add_new_link( $url );
	}
	// $return = yourls_add_new_link( $_REQUEST['url'], $_REQUEST['keyword'] );
	// echo json_encode( $return );
	die();
});
