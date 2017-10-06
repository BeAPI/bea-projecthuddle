<?php

namespace BEA\ProjectHuddle\Admin;

use BEA\ProjectHuddle\Singleton;

/**
 * Basic class for Admin
 *
 * Class Main
 *
 * @package BEA\ProjectHuddle\Admin
 */
class Main {
	/**
	 * Use the trait
	 */
	use Singleton;

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_action( 'admin_init', [ $this, 'admin_init' ] );
		add_action( 'admin_footer', [ $this, 'admin_footer' ] );
	}

	public function admin_menu() {
		add_submenu_page( 'tools.php', __( 'ProjectHuddle Code', 'bea-projecthuddle' ), __( 'ProjectHuddle Code', 'bea-projecthuddle' ), 'manage_options', 'bea-projecthuddle', [
			$this,
			'options_page',
		] );
	}

	public function admin_init() {

		register_setting( 'bea_projecthuddle_page', 'bea_projecthuddle_code' );

		add_settings_section(
			'bea_projecthuddle_section',
			'',
			'',
			'bea_projecthuddle_page'
		);

		add_settings_field(
			'bea_projecthuddle_code',
			__( 'Javascript Code', 'bea-projecthuddle' ),
			[ $this, 'code_field_render' ],
			'bea_projecthuddle_page',
			'bea_projecthuddle_section'
		);
	}


	public function code_field_render() {
		$code = get_option( 'bea_projecthuddle_code' );
		?>
        <textarea cols="80" rows="15" name="bea_projecthuddle_code"><?php echo $code; ?></textarea>
		<?php
	}


	public function options_page() {
		?>
        <form action="options.php" method="post">

            <h2><?php esc_html_e( 'ProjectHuddle Code', 'bea-projecthuddle' ); ?></h2>

			<?php
			settings_fields( 'bea_projecthuddle_page' );
			do_settings_sections( 'bea_projecthuddle_page' );
			submit_button();
			?>
        </form>
		<?php
	}

	public function admin_footer() {
		$code = get_option( 'bea_projecthuddle_code' );
		if ( empty( $code ) ) {
			return false;
		}

		echo $code;
	}
}