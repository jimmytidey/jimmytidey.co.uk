<?php


/**
 * GPAISRTranslation class.
 */
class GPAISRTranslation {


	/**
	 * __construct function.
	 *
	 * @access public
	 * @since  0.6
	 * @return \GPAISRTranslation
	 */
	function __construct() {
		// register the translation function
		add_action( 'init', array( $this, 'load_translation' ) );
	}


	/**
	 * load_translation function.
	 * loads the translation file
	 *
	 * @access public
	 * @since  0.6
	 * @return void
	 */
	function load_translation() {
		load_plugin_textdomain( 'gpaisr', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

}