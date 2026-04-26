<?php
/**
 * Festipiousse - Thème enfant de Twenty Twenty-Five
 *
 * @package Festipiousse
 */

/**
 * Chargement des styles du thème parent et enfant.
 */
function festipiousse_enqueue_styles() {
	wp_enqueue_style(
		'twentytwentyfive-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	wp_enqueue_style(
		'festipiousse-style',
		get_stylesheet_uri(),
		array( 'twentytwentyfive-style' ),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'festipiousse-my-css',
		get_stylesheet_directory_uri() . '/assets/css/my_css.css',
		array( 'festipiousse-style' ),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'festipiousse-bubbles',
		get_stylesheet_directory_uri() . '/assets/js/bubbles.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'festipiousse_enqueue_styles' );

/**
 * Enregistrement des blocs ACF du thème.
 */
function festipiousse_register_blocks() {
	if ( ! function_exists( 'acf_register_block_type_from_metadata' ) ) {
		return;
	}
	foreach ( glob( get_stylesheet_directory() . '/blocks/*', GLOB_ONLYDIR ) as $block_dir ) {
		register_block_type( $block_dir );
	}
}
add_action( 'init', 'festipiousse_register_blocks' );

function festipiousse_register_block_styles() {
	register_block_style( 'core/button', [
		'name'  => 'secondaire',
		'label' => 'Secondaire',
	] );
}
add_action( 'init', 'festipiousse_register_block_styles' );

/**
 * Chemin local pour la sauvegarde JSON des groupes ACF.
 */
function festipiousse_acf_json_save_path( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'festipiousse_acf_json_save_path' );

function festipiousse_acf_json_load_paths( $paths ) {
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'festipiousse_acf_json_load_paths' );
