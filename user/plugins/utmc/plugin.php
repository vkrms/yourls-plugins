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
yourls_add_action( 'admin_page_before_form', function() {

	/** Available sources */
	$sources = [
		'Facebook.com',
		'Vk.com',
		'Twitter.com',
		'Telegram',
		'Whatsapp',
		'Travelpayouts',
		'Blog.travelpayouts.com',
		'Webinar.travelpayouts.com',
		'Aviasales.ru',
	];

	require( 'utmc-template.php' );
});

// https://www.travelpayouts.com/campaigns/84/promos?utm_source=facebook&utm_medium=organic&utm_campaign=booking&utm_content=17_05_19

// utm_source=facebook
// utm_medium=organic
// utm_campaign=booking
// utm_content=17_05_19
