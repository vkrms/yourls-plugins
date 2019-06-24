<?php
/*
Plugin Name: Facelift
Plugin URI: ¯\_(ツ)_/¯
Description: Lifts face
Version: 1.0
Author: vkrms
Author URI: github.com/vkrms
*/

function facelift_resource( $url ) {
	$dir_rel = str_replace( $_SERVER['DOCUMENT_ROOT'], '', __DIR__ ) . DIRECTORY_SEPARATOR;
	return $dir_rel . $url;
}

yourls_add_action( 'html_head', function() {
	?>
		<link rel="stylesheet" href="<?php echo facelift_resource( 'facelift.css' ) ?>"/>
	<?php
});
