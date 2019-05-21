<?php
/*
Plugin Name: My First Plugin
Plugin URI: https://github.com/YOURLS/YOURLS/wiki/Plugins
Description: Sample (pointless) plugin that interrupts short URLs redirection and creates absurdly long short URLs
Version: 1.0
Author: Ozh
Author URI: http://ozh.org/
*/

// Hook our custom function into the 'pre_redirect' event
yourls_add_action( 'pre_redirect', 'warning_redirection' );

// Our custom function that will be triggered when the event occurs
function warning_redirection( $args ) {
    $url  = $args[0];
    $code = $args[1]; // Print the message
    echo "<p>This is a redirection page to: $url</p>";
    echo "<p>Click <a href='$url'>here</a> to proceed</p>";

    // Now die so the normal flow of event is interrupted
    die();
}

// hook our custom function into the 'random_keyword' filter
yourls_add_filter( 'random_keyword', 'my_silly_function' );

// Our silly custom function
function my_silly_function( $original_keyword ) {
	$silly_keyword = $original_keyword . "iloveyourls";

	// a filter function MUST return something once its arguments are processed
	return $silly_keyword;
}


// And that's it!
