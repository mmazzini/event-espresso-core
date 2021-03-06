<?php
/**
 * Bootstrap for EE Unit Tests
 *
 * @since 		4.3.0
 * @package 		Event Espresso
 * @subpackage 	Tests
 */
require( dirname( __FILE__ ) . '/includes/define-constants.php' );
// load PSR4 autoloader
require_once( EE_PLUGIN_DIR . 'core/Psr4Autoloader.php' );
if ( ! file_exists( WP_TESTS_DIR . '/includes/functions.php' ) ) {
	die( "The WordPress PHPUnit test suite could not be found.\n" );
}

require_once WP_TESTS_DIR . '/includes/functions.php';

function _install_and_load_event_espresso() {
	require EE_TESTS_DIR . 'includes/loader.php';
}
tests_add_filter( 'muplugins_loaded', '_install_and_load_event_espresso' );

require WP_TESTS_DIR . '/includes/bootstrap.php';
require_once( EE_CORE . 'EE_Dependency_Map.core.php' );
require_once( EE_CORE . 'request_stack' . DS . 'EE_Request.core.php' );
require_once( EE_CORE . 'request_stack' . DS . 'EE_Response.core.php' );
EE_Dependency_Map::instance( new EE_Request( $_GET, $_POST, $_COOKIE ), new EE_Response() );
//Load the EE_specific testing tools
require EE_TESTS_DIR . 'includes/EE_UnitTestCase.class.php';

require_once EE_TESTS_DIR . 'mocks/addons/eea-new-addon/eea-new-addon.php';
remove_action( 'AHEE__EE_System__load_espresso_addons', 'load_espresso_new_addon' );
//save wpdb queries in case we want to know what queries ran during a test
define( 'SAVEQUERIES', TRUE );

/**
 * redefining wp_mail function here as a mock for our tests.  Has to be done early
 * to override the existing wp_mail.  Tests can use the given filter to adjust the responses as necessary.
 */
function wp_mail( $to, $subject, $message, $headers = '', $attachments = array() ) {
	return apply_filters( 'FHEE__wp_mail', true, $to, $subject, $message, $headers, $attachments );
}