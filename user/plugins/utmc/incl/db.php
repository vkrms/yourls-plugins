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

	$query2 = 'CREATE TABLE IF NOT EXISTS `utmc_presets` (
			`id` int(11) NOT NULL auto_increment,
			`name` varchar(200) NOT NULL,
			`utm_source` varchar(200),
			`utm_medium` varchar(200),
			`utm_campaign` varchar(200),
			`utm_content` varchar(200),
			`utm_term` varchar(200),
			PRIMARY KEY (`id`),
			UNIQUE INDEX `NAME_UNIQUE` (`NAME` ASC)
		) AUTO_INCREMENT=1';

	$queries = [
		[
			'table_name' => 'utmc_params',
			'sql'        => $query,
		],
		[
			'table_name' => 'utmc_presets',
			'sql'        => $query2,
		],
	];

	// Create tables
	global $ydb;
	foreach ( $queries as $query ) {

		$ydb->query( $query['sql'] );

		$table_name = $query['table_name'];

		$create_success = $ydb->query( "SHOW TABLES LIKE '$table_name'" );
		if ( $create_success ) {
			$success_msg[] = yourls_s( "Table '%s' created.", $table_name );
		} else {
			$error_msg[] = yourls_s( "Error creating table '%s'.", $table_name );
		}
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
			$query = "INSERT IGNORE INTO `utmc_params` (`value`) VALUES ('$val')";
			$ydb->query( $query );
		}
	}

	return [
		'success' => $success_msg,
		'error'   => $error_msg,
	];

});
