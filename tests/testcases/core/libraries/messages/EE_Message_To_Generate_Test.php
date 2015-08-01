<?php
/**
 * Contains test class for /core/libraries/messages/EE_Messages_Queue.lib.php
 *
 * @since  		4.9.0
 * @package 	Event Espresso
 * @subpackage 	tests
 */

/**
 * All tests for the EE_Message_To_Generate class.
 *
 * @since 		4.9.0
 * @package 	Event Espresso
 * @subpackage 	tests
 */
class EE_Message_To_Generate_Test extends EE_UnitTestCase {


	/**
	 * @return EE_Message_To_Generate
	 */
	function test_construct() {
		$ee_msg = EE_Registry::instance()->load_lib( 'messages' );
		$mtg = new EE_Message_To_Generate(
			'email',
			'registration',
			array(),
			$ee_msg,
			'admin',
			true
		);

		//verify public properties setup properly
		$this->assertEquals( 'registration', $mtg->message_type );
		$this->assertEquals( 'email', $mtg->messenger );
		$this->assertEquals( array(), $mtg->data );
		$this->assertEquals( 'admin', $mtg->context );
		$this->assertTrue( $mtg->preview );
		return $mtg;
	}




	/**
	 * @depends test_construct
	 * @param EE_Message_To_Generate $mtg
	 */
	function test_get_EE_Message( EE_Message_To_Generate $mtg ) {
		/** @type EE_Message $msg */
		$msg = $mtg->get_EE_Message();
		$this->assertInstanceOf( 'EE_Message', $msg );
		$this->assertEquals( 'email', $msg->messenger() );
		$this->assertEquals( 'registration', $msg->message_type() );
		$this->assertEquals( 'admin', $msg->context() );
		$this->assertEquals( EEM_Message::status_incomplete, $msg->STS_ID() );

		//this is also implicitly testing the _get_priority_for_message_type method because Registration message type
		//and email messenger should result in EEM_Message::priority_medium.
		$this->assertEquals( EEM_Message::priority_medium, $msg->priority() );
	}

} //end EE_Message_To_Generate_Test class