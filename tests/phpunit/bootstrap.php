<?php

/**
 * If Xdebug is installed disable stack traces for phpunit
 */
if ( function_exists( 'xdebug_disable' ) ) {
	xdebug_disable();
}

/**
 * Gravity PDF Unit Tests Bootstrap
 *
 * @since 4.0
 */
class GravityPdfDeveloperToolkitUnitTestsBootstrap {

	/** @var string directory where wordpress-tests-lib is installed */
	public $wp_tests_dir;

	/** @var string testing directory */
	public $tests_dir;

	/** @var string plugin directory */
	public $plugin_dir;

	/**
	 * Setup the unit testing environment
	 *
	 * @since 4.0
	 */
	public function __construct() {
		$this->tests_dir    = dirname( __FILE__ );
		$this->plugin_dir   = dirname( $this->tests_dir ) . '/..';
		$this->wp_tests_dir = $this->plugin_dir . '/tmp/wordpress-tests-lib';

		/* load test function so tests_add_filter() is available */
		require_once $this->wp_tests_dir . '/includes/functions.php';

		/* load Gravity PDF */
		tests_add_filter( 'muplugins_loaded', [ $this, 'load' ] );
		tests_add_filter( 'plugins_loaded', [ $this, 'gravitypdfReset' ], 20 );

		/* load the WP testing environment */
		require_once( $this->wp_tests_dir . '/includes/bootstrap.php' );
	}

	/**
	 * Load Gravity Forms and Gravity PDF
	 *
	 * @since 4.0
	 */
	public function load() {
		require_once $this->plugin_dir . '/tmp/gravityforms/gravityforms.php';
		require_once $this->plugin_dir . '/tmp/gravity-forms-pdf-extended/pdf.php';

		/* set up Gravity Forms database */
		RGFormsModel::drop_tables();
		( function_exists( 'gf_upgrade' ) ) ? gf_upgrade()->maybe_upgrade() : @GFForms::setup( true );

		require $this->plugin_dir . '/gravity-pdf-developer-toolkit.php';

		/* Setup testing logger */
		require $this->plugin_dir . '/tmp/gravity-forms-pdf-extended/vendor/autoload.php';

		/* TODO: remove once upgraded to Mpdf v7 */
		error_reporting( E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED );
	}

	public function gravitypdfReset() {
		global $gfpdf;

		\GFPDF\Router::initialise_plugin();
		$gfpdf->misc->rmdir( $gfpdf->data->template_location );
	}
}

$GLOBALS['GFPDF_Test'] = new GravityPdfDeveloperToolkitUnitTestsBootstrap();
