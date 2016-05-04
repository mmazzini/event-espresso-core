<?php
namespace EventEspresso\core\services\progress_steps;

if ( ! defined( 'EVENT_ESPRESSO_VERSION' ) ) {
	exit( 'No direct script access allowed' );
}



/**
 * Interface ProgressStepInterface
 *
 * @package EventEspresso\core\services\progress_steps
 */
interface ProgressStepInterface {

	/**
	 * @return boolean
	 */
	public function isCurrent();

	/**
	 * @param boolean $is_current
	 */
	public function setIsCurrent( $is_current = true );

	/**
	 * @return int|string
	 */
	public function id();

	/**
	 * @return string
	 */
	public function htmlClass();

	/**
	 * @return string
	 */
	public function text();

}
// End of file ProgressStepInterface.php
// Location: /ProgressStepInterface.php