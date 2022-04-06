<?php

yourls_add_action( 'activated_plugin', function ( $plugin ) {

	// gtfo other plugins! ><
	$plugin_name = yourls_plugin_basename( $plugin[0] );
	if ( 'utmc/plugin.php' !== $plugin_name ) {
		return false;
	}

	$query = 'CREATE TABLE IF NOT EXISTS `utmc_params` (
			`id` int(11) NOT NULL auto_increment,
			`value` varchar(200) NOT NULL,
			`used` int(11) DEFAULT 0,
			PRIMARY KEY (`id`),
			UNIQUE INDEX `VALUE_UNIQUE` (`VALUE` ASC)
		) AUTO_INCREMENT=1';

	// Create tables
	global $ydb;
	$ydb->query( $query );

	$table_name = 'utmc_params';

	$create_success = $ydb->query( "SHOW TABLES LIKE '$table_name'" );
	if ( $create_success ) {
		$success_msg[] = yourls_s( "Table '%s' created.", $table_name );
	} else {
		$error_msg[] = yourls_s( "Error creating table '%s'.", $table_name );
	}

	$options = [
		'utm_source' => [
			'Facebook.com',
			'Vk.com',
			'Twitter.com',
			'Telegram',
			'Whatsapp',
			'Travelpayouts',
			'Blog.travelpayouts.com',
			'Webinar.travelpayouts.com',
			'Aviasales.ru',
			'Linkedin.com',
			'Youtube.com',
			'Instagram.com',
			'Bizdev',
		],
		'utm_medium'  => [
			'paid',
			'referral',
			'affiliate',
			'social',
		],
	];

	foreach ( $options as $type => $options_group ) {
		foreach ( $options_group as $option ) {
			$val   = "{$type}={$option}";
			$query = "INSERT INTO `utmc_params` (`value`) VALUES ('$val')";
			$ydb->query( $query );
		}
	}

	return [
		'success' => $success_msg,
		'error'   => $error_msg,
	];

});
