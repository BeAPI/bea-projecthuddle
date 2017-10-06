<?php
namespace BEA\ProjectHuddle;

/**
 * The purpose of the main class is to init all the plugin base code like :
 *  - Taxonomies
 *  - Post types
 *  - Shortcodes
 *  - Posts to posts relations etc.
 *  - Loading the text domain
 *
 * Class Main
 * @package BEA\ProjectHuddle
 */
class Main {
	/**
	 * Use the trait
	 */
	use Singleton;

	protected function init() {
		add_action( 'init', array( $this, 'init_translations' ) );
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
	}

	/**
	 * Load the plugin translation
	 */
	public function init_translations() {
		// Load translations
		load_plugin_textdomain( 'bea-projecthuddle', false, BEA_PROJECTHUDDLE_PLUGIN_DIRNAME . '/languages' );
	}

	public function wp_footer() {
		$code = get_option( 'bea_projecthuddle_code' );
		if ( empty( $code ) ) {
			return false;
		}

		echo $code;
	}
}