<?php

class GPAISRTranslation {

	function __construct(){
		add_action('init', array($this, 'load_translation'));
	}


	function load_translation(){
		load_plugin_textdomain( 'gpaisr', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}
	
}